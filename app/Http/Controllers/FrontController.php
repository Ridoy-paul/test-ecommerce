<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index() {
        $products = Products::inRandomOrder()->get();
        return view('front.index', compact('products'));
    }
}
