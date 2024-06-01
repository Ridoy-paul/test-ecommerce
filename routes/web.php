<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TransactionsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "ddd";
})->name('index');

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

        Route::group(['prefix'=>'transaction', 'as'=>'transaction.'], function(){

            Route::controller(TransactionsController::class)->group(function () {
                Route::get('/all', 'allTransactions')->name('all');
                Route::get('/deposit/create', 'createDeposit')->name('deposit.create');
                Route::post('/deposit/store', 'storeDeposit')->name('deposit.store');
                Route::get('/deposit/list', 'depositList')->name('deposit.list');

                Route::get('/withdraw/create', 'createWithdraw')->name('withdraw.create');
                Route::post('/withdraw/store', 'storeWithdraw')->name('withdraw.store');
                Route::get('/withdraw/list', 'withdrawList')->name('withdraw.list');
                
                
                
                
            });

        });

        
    });
  
    


});
