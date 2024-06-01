<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
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
        $product->min_order_qty = $request->min_order_qty;
        $product->unit_type = $request->unit_type;
        $product->serial_number = $request->serial_number ?? 'SN-' . strtoupper(uniqid());
        $product->price = $request->price;
        $product->original_or_copy = $request->original_or_copy;
        $product->descriptions = $request->descriptions;

        if ($request->hasFile('thumbnail_image')) {
            $product->thumbnail_image = $request->file('thumbnail_image')->store('products/thumbnails');
        }

        if ($request->hasFile('gallery_images')) {
            $galleryImages = [];
            foreach ($request->file('gallery_images') as $file) {
                $galleryImages[] = $file->store('products/gallery');
            }
            $product->gallery_images = json_encode($galleryImages);
        }

        $product->save();

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
    public function edit(Products $products)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $products)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products)
    {
        //
    }
}
