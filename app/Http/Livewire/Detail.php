<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Detail extends Component
{
    public $product;
    public function mount($slug){
        $this->product = $product = Product::where('slug', $slug)
            ->with('colors')->first();
    }
    public function render()
    {
        return view('livewire.detail', [
            'product' => $this->product
        ])->extends('index')->section('contents');
    }
}
