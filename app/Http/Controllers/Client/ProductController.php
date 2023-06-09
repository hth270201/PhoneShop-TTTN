<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Product;
use App\Services\VNPayServices;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $top_product = Product::orderBy('rate', 'DESC')->orderBy('price', 'DESC')->limit(10)->get();
        $releated_product = Product::orderBy('price', 'DESC')->limit(10)->get();
        VNPayServices::create();
        dump($_GET);
        return view('pages.home', [
            'top_product' => $top_product,
            'releated_prodct' => $releated_product
        ]);
    }

    public function detail($slug)
    {
        $product = Product::where('slug', $slug)->first();
        return view('pages.detail', [
            'product' => $product
        ]);
    }
    public function colorPrice($color_id){
        $color = Color::where('id', $color_id)->first();

        return response()->json(['price' => number_format($color->price)]);
    }
}
