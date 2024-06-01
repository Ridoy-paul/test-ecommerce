<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;


Route::get('/',  [FrontController::class, 'index'])->name('index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard',  [HomeController::class, 'dashboard'])->name('account.dashboard');

    Route::middleware(['isAccountHolder'])->group(function () {

        Route::group(['prefix'=>'product', 'as'=>'product.'], function(){

            Route::controller(ProductsController::class)->group(function () {
                Route::get('/all', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::put('/update/{id}', 'update')->name('update');

            });

        });
    });
});
