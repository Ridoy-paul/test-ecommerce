<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\District;
use App\Models\User;
use App\Helpers\FileHelper;
use Illuminate\Support\Facades\Hash;
use DataTables;

class HomeController extends Controller
{
    public function __construct()
    {
       
    }

    public function dashboard()
    {
        try {
            $userId = Auth::user()->id;
            return view('admin.pages.dashboard.home');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function sellerList(Request $request)
    {
        try {
            if(Auth::user()->account_type <> 'super_admin') {
                return redirect()->back()->with('error', 'You can not access this page.');
            }

            if ($request->ajax()) {

                $sellerList = User::where('acctount_type', 'seller')->orderBy('id', 'DESC')->get();

                return Datatables::of($sellerList)
                        ->addIndexColumn()
                        ->addColumn('district_name', function($row){
                            return $row->seller_info->name;
                        })
                        ->addColumn('product_qty', function($row){
                            $createdAt = Carbon::parse($row->created_at);
                            $diffInMinutes = $createdAt->diffInMinutes();
                            $diffInHours = $createdAt->diffInHours();
                            $hours = floor($diffInMinutes / 60);
                            $minutes = $diffInMinutes % 60;
                        
                            $formattedTime = sprintf('%02d : %02dm ago', $hours, $minutes);
                            return $formattedTime;
                        })
                        
                        ->addColumn('action', function($row){
                            $editUrl = route('product.edit', encrypt($row->id));
                            //$deleteUrl = route('product.destroy', $row->id);
                            
                            return '
                                <a href="' . $editUrl . '" class="btn btn-primary btn-sm">Edit</a>
                                <a href="' . $editUrl . '" class="btn btn-danger btn-sm">Delete</a>
                            ';
                        })
                        
                        ->rawColumns(['district_name', 'product_qty', 'action'])
                        ->make(true);
            }
            
            return view('admin.pages.seller.list');
        } 
        catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function sellerCreate()
    {
        try {
            if(Auth::user()->account_type <> 'super_admin') {
                return redirect()->back()->with('error', 'You can not access this page.');
            }
            $districtList = District::all();
            return view('admin.pages.seller.create', compact('districtList'));
        } 
        catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function sellerStore(Request $request)
    {
        if(Auth::user()->account_type <> 'super_admin') {
            return redirect()->back()->with('error', 'You can not access this page.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'required|string|max:20',
            'district_code' => 'required|string|max:255',
            'address' => 'nullable|string',
            'password' => 'required|string|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
        ]);

        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phone = $validatedData['phone'];
        $user->disctrict_code = $validatedData['district_code'];
        $user->adress = $validatedData['address'];
        $user->password = Hash::make($validatedData['password']);

        if ($request->hasFile('image')) {
            $user->image = FileHelper::uploadImage($request->image, 'images');
        }
        
        $user->save();

        return redirect()->route('seller.list')->with('success', 'Seller created successfully.');
    }

    public function getProfile($id)
    {
        try {
            $id = decrypt($id);
            $user = User::where('id', $id)->first();
            $districtList = District::all();
            return view('admin.pages.account.profile', compact('user', 'districtList'));
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function updateProfile(Request $request)
    {
        $id = decrypt($request->userId);
        $user = User::where('id', $id)->first();
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
            'disctrict_code' => 'required|string|max:255',
            'address' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
        ]);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phone = $validatedData['phone'];
        $user->disctrict_code = $validatedData['disctrict_code'];
        $user->adress = $validatedData['address'];

        if ($request->hasFile('image')) {
            FileHelper::deleteImage($user->image, 'images');
            $user->image = FileHelper::uploadImage($request->image, 'images');
        }

        $user->save();

        return redirect()->route('account.profile', ['id' => encrypt($user->id)])->with('success', 'Profile updated successfully.');
    }

    


}
