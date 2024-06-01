<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transactions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
        } 
        catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }
}
