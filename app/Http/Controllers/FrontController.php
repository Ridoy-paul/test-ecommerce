<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index() {
        $products = Products::with([
            'seller_info' => function($query) {
                $query->select('id', 'name', 'image', 'disctrict_code');
            }
        ])->inRandomOrder()->get(['id', 'seller_id', 'title', 'thumbnail_image', 'unit_type', 'min_order_qty', 'serial_number', 'average_review', 'original_or_copy']);

       
        return view('front.index', compact('products'));
    }
}
