<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(){
        $cart = Cart::where('user_id', Auth::id())->first();
        if ($cart){
            return view('cart_checkout', compact('cart'));
        }else{
            return redirect()->back();
        }
    }

    public function confirm($order_id){
        $order = Order::where('id', $order_id)->first();
        $cart = $order->cart()->first();
        return view('pages.checkout_confirm', compact('order', 'cart'));
    }
}
