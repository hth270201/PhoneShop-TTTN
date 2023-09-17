<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Checkout extends Component
{
    public $cart;
    public ?string $qty = '';

    //form data
    public ?string $user_name;
    public ?string $email;
    public ?string $phone;
    public ?string $address;

    protected $rules = [
        'user_name' => 'required|max:30|min:10',
        'email' => 'required|email',
        'address' => 'required|max:200',
        'phone' => 'required|min:10'
    ];
    public function render()
    {
        $content = null;
        if ($this->cart){
            $content = $this->cart->content;
        }
        return view('livewire.checkout', compact('content'));
    }

    public function removeProduct($key){
        $content = $this->cart->content;
        unset($content[$key]);
        $this->cart->content = $content;
        $total_price = 0;
        foreach ($this->cart->content as $content){
            $total_price += $content['price'] * $content['count'];
        }
        $this->cart->total_price = $total_price;
        $this->cart->save();
    }

    public function qtyUpdate($key){
        $content = $this->cart->content;
        $content[$key]['count'] = (int)$this->qty;
        $this->cart->content = $content;
        $total_price = 0;
        foreach ($this->cart->content as $item){
            $total_price += $item['price'] * $item['count'];
        }
        $this->cart->total_price = $total_price;
        $this->cart->save();
    }

    public function order(){
        $cart = \App\Models\Cart::create(Arr::only($this->cart->toArray(), [
            'user_id', 'content', 'total_price'
        ]));

        $validatedData = $this->validate();

        $validatedData['cart_id'] = $cart->id;
        $validatedData['total_price'] = $cart->total_price;
        if (Auth::check()){
            $validatedData['user_id'] = Auth::id();
        }

        $order = Order::create($validatedData);
        return redirect()->route('client.checkout.confirm', ['order_id' => $order->id]);
    }
}
