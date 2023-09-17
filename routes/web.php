<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Client\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('')->group(function (){
    Route::get("", [ProductController::class, 'index']);
    Route::get('/home', [ProductController::class, 'index'])->name('client.home');
    Route::get('/product/{slug}/detail', [ProductController::class, 'detail'])->name('client.detail');
    Route::get('/product/{color}/price', [ProductController::class, 'colorPrice'])->name('client.detail.color');
    Route::get('/product/list', [ProductController::class, 'list'])->name('client.list.show');
    Route::post('/product/list_product', [ProductController::class, 'list'])->name('client.list');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('client.checkout');
    Route::get('/checkout/{order_id}/confirm', [CheckoutController::class, 'confirm'])->name('client.checkout.confirm');
    Route::post('/product/search', [ProductController::class, 'search'])->name('client.search');

    Route::get('/logout', function (){
        if (Auth::user()){
            Auth::logout();
            return redirect()->route('client.home');
        }else{
            return redirect()->route('client.home');
        }
    })->name('client.logout');
    Route::middleware(['auth'])->group(function (){

   });
});


Auth::routes();
