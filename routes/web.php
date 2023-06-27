<?php

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
    Route::get('/', [ProductController::class, 'index'])->name('client.home');
    Route::get('/product/{product}/detail', [ProductController::class, 'detail'])->name('client.detail');
    Route::get('/product/{color}/price', [ProductController::class, 'colorPrice'])->name('client.detail.color');
    Route::get('/product/list', [ProductController::class, 'list'])->name('client.list');
    Route::post('/product/list', [ProductController::class, 'list'])->name('client.list');

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

Route::get('/home', [ProductController::class, 'index'])->name('home');
