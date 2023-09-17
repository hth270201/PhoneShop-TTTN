<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $top_product = Product::orderBy('rate', 'DESC')->orderBy('price', 'DESC')->limit(10)->get();
        $releated_product = Product::orderBy('price', 'DESC')->limit(10)->get();
        return view('livewire.home', compact('top_product', 'releated_product'));
    }
}
