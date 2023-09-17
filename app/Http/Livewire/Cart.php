<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Cart as Model;

class Cart extends Component
{
    public function render()
    {
        $cart = null;
        if (Auth::check()){
            $cart = $this->show();
        }
        return view('livewire.cart_pop_modal', compact('cart'));
    }

    protected function show(){
        $cart = Auth::user()->carts()->latest()->first();
        return $cart;
    }
}
