<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transactions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\District;
use App\Models\User;
use App\Helpers\FileHelper;

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
