<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Models\ProductGalleries;
use App\Models\Products;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {

                $query = Products::with([
                    'seller_info' => function($query) {
                        $query->select('id', 'name');
                    }
                ]);

                if(Auth::user()->account_type == 'seller') {
                    $query = $query->where('seller_id', Auth::user()->id);
                }

                $query = $query->orderBy('id', 'DESC')->get();

                return Datatables::of($query)
                        ->addIndexColumn()
                        ->addColumn('seller_name', function($row){
                            return $row->seller_info->name;
                        })
                        ->addColumn('created_at', function($row){
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
                            $deleteUrl = route('product.destroy', ['id' =>  encrypt($row->id)]);
                            
                            return '
                                <a href="' . $editUrl . '" class="btn btn-primary btn-sm">Edit</a>
                                <a href="javascript:void(0)" class="btn btn-danger btn-sm" type="button" onclick="globalDeleteConfirm(\'' .$deleteUrl. '\')" data-bs-toggle="modal" data-bs-target="#globalDeleteModal">Delete</a>
                            ';
                        })
                        
                        ->rawColumns(['seller_name', 'action'])
                        ->make(true);
            }

            return view('admin.pages.product.index');

        } 
        catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('admin.pages.product.create_or_edit');
        } 
        catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function generateProductSerial($number) {
        $serial = str_pad($number, 5, '0', STR_PAD_LEFT);
        $verifyBarcode = Products::where('serial_number', $serial)->first(['id']);
    
        if (!is_null($verifyBarcode)) {
            $number++;
            return $this->generateProductSerial($number);
        }
    
        return $serial;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'min_order_qty' => 'required|integer',
            'unit_type' => 'required',
            'serial_number' => 'nullable|unique:products',
            'price' => 'nullable|numeric',
            'original_or_copy' => 'required',
            'descriptions' => 'nullable',
        ]);

        $product = new Products;
        $product->title = $request->title;
        $product->seller_id = Auth::user()->id;
        $product->min_order_qty = $request->min_order_qty;
        $product->unit_type = $request->unit_type;

        if($request->serial_number == '') {
            $countProduct = Products::count('id');
            $countProduct++;
            $barcode = $this->generateProductSerial($countProduct);
            $product->serial_number = $barcode;
        } else {
            $product->serial_number = $request->serial_number;
        }
        
        $product->price = $request->price;
        $product->original_or_copy = $request->original_or_copy;
        $product->descriptions = $request->descriptions;

        if ($request->hasFile('thumbnail_image')) {
            $product->thumbnail_image = FileHelper::uploadImage($request->thumbnail_image, 'images');
        }

        $product->save();

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $galleryImage = new ProductGalleries();
                $galleryImage->product_id = $product->id;
                $galleryImage->image = FileHelper::uploadImage($file, 'images');
                $galleryImage->save();
            }
        }

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $id = decrypt($id);
            $product = Products::with('galleries')->find($id);
            return view('admin.pages.product.create_or_edit', compact('product'));
        } 
        catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'min_order_qty' => 'required|integer',
            'unit_type' => 'required',
            'serial_number' => 'nullable|unique:products,serial_number,' . $id,
            'price' => 'nullable|numeric',
            'original_or_copy' => 'required',
            'descriptions' => 'nullable',
        ]);
    
        $product = Products::find($id);
    
        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Product not found.');
        }
    
        $product->title = $request->title;
        $product->min_order_qty = $request->min_order_qty;
        $product->unit_type = $request->unit_type;
        $product->serial_number = $request->serial_number ?? $product->serial_number;
        $product->price = $request->price;
        $product->original_or_copy = $request->original_or_copy;
        $product->descriptions = $request->descriptions;
    
        if ($request->hasFile('thumbnail_image')) {
            FileHelper::deleteImage($product->thumbnail_image, 'images');
            $product->thumbnail_image = FileHelper::uploadImage($request->thumbnail_image, 'images');
        }
    
        $product->save();
    
        if ($request->hasFile('gallery_images')) {
            $oldGalleryImages = ProductGalleries::where('product_id', $product->id)->get();
            foreach ($oldGalleryImages as $oldImage) {
                FileHelper::deleteImage($oldImage->image, 'images');
                $oldImage->delete();
            }
    
            foreach ($request->file('gallery_images') as $file) {
                $galleryImage = new ProductGalleries();
                $galleryImage->product_id = $product->id;
                $galleryImage->image = FileHelper::uploadImage($file, 'images');
                $galleryImage->save();
            }
        }
    
        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $id = decrypt($id);
            $product = Products::find($id);
            if (is_null($product)) {
                return redirect()->back()->with('error', 'No Product Found!');
            }

            if (!empty($product->thumbnail_image)) {
                $imagePath = public_path('images/' . $product->thumbnail_image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $product->delete();
            return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

}
