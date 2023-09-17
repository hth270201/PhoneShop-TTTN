<?php

namespace App\Orchid\Screens;

use App\Models\Cart;
use App\Models\Color;
use App\Models\Order;
use App\Models\Product;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class OrderListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'orders' => Order::paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Order List';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('orders', [
                TD::make('id', 'ID')
                    ->render(function (Order $order){
                        return $order->id;
                    }),
                TD::make('user_name', 'User Name')
                    ->render(function (Order $order){
                        return $order->user_name;
                    }),
                TD::make('address', 'Address')
                    ->render(function (Order $order){
                        return $order->address;
                    }),
                TD::make('email', 'Email')
                    ->render(function (Order $order){
                        return $order->email;
                    }),
                TD::make('phone', 'Phone')
                    ->render(function (Order $order){
                        return $order->phone;
                    }),
                TD::make('cart', 'Cart')
                    ->render(function (Order $order){
                        $html = "";
                        $cart = Cart::where('id', $order->cart_id)->first();
                        $content = $cart->content;
                        foreach ($content as $item){
                            $product = Product::where('id', $item['product_id'])->first();
                            $color = Color::where('id', $item['color_id'])->first();
                            $html .= Link::make($product->name)->route('client.detail', ['slug' => $product->slug])->target('blank').
                                "<span><i style='color: red'>Count: (".$item['count'].")</i> - <b>Price: ".number_format($color->price)."</b> - Color: $color->color</span>";
                        }
                        return $html;
                    }),
                TD::make('payment', 'Payment')
                    ->render(function (Order $order){
                        if ($order->payment == 0){
                            return "COD";
                        }else{
                            return "Banking";
                        }
                    }),
                TD::make('total_price', 'Total Price')
                    ->render(function (Order $order){
                        return number_format($order->total_price);
                    }),
            ])
        ];
    }
}
