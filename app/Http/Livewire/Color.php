<?php

namespace App\Http\Livewire;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Cart;
use App\Models\Color as ColorModel;

class Color extends Component
{
    public $product;
    public $cart;
    public function mount($product){
        $this->product = $product;
    }
    public function render()
    {
        return view('livewire.color_select', [
            'product' => $this->product,
            'cart' => $this->cart
        ]);
    }

    public function check(ColorModel $color){
        if (!Auth::check()){
            return redirect()->route('login');
        }else{
            if ($cart = Auth::user()->carts()->first()){
                $check = false;
                $contents = $cart->content;
                foreach ($contents as $key => $content){
                    if (($content['product_id'] == $color->product_id) && ($content['color_id'] == $color->id)){
                        $contents[$key]['count'] = ++$content['count'];
                        $check = true;
                    }
                }
                if (!$check){
                    $contents = array_merge($contents, [
                        [
                            'product_id' => $color->product_id,
                            'color_id' => $color->id,
                            'count' => 1,
                            'price' => $color->price,
                        ]
                    ]);
                }
                $total_price = 0;
                foreach ($contents as $content){
                    $total_price += $content['price'] * $content['count'];
                }
                $cart->content = $contents;
                $cart->total_price = $total_price;
                $cart->save();
                $color->count--;
                $color->save();
            }else{
                $contents = [
                    [
                        'product_id' => $color->product_id,
                        'color_id' => $color->id,
                        'count' => 1,
                        'price' => $color->price,
                    ]
                ];
                $total_price = 0;
                foreach ($contents as $content){
                    $total_price += $content['price'] * $content['count'];
                }
                if ($color->count > 0){
                    $cart = new Cart([
                        'user_id' => Auth::id(),
                        'content' => $contents,
                        'total_price' => $total_price
                    ]);
                    $cart->save();
                    $color->count--;
                    $color->save();
                }
            }
        }
//        $this->redirect(route('client.home'));
    }
}
