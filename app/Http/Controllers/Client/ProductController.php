<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $top_product = Product::orderBy('rate', 'DESC')->orderBy('price', 'DESC')->limit(10)->get();

        return view('pages.home', [
            'top_product' => $top_product
        ]);
    }
}
