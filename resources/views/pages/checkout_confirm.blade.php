@extends('index')

@section('contents')
    <div class="order-inner float-left w-100">
        <div class="container">
            <div class="row">
                <div id="order-confirmation" class="card float-left w-100 mb-10">
                    <div class="card-block p-20">
                        <h2 class="card-title text-success">Your order is confirmed</h2>
                    </div>
                </div>

                <div id="order-itens" class="card float-left w-100 mb-10">
                    <div class="card-block p-20">
                        <h3 class="card-title">Order items</h3>
                        <div class="order-confirmation-table float-left w-100">
                            <div class="order-line float-left w-100">
                                <div class="row">
                                    @foreach($cart->content as $item)
                                        @php
                                            $product = \App\Models\Product::where('id', $item['product_id'])->first();
                                            $color = \App\Models\Color::where('id', $item['color_id'])->first();
                                        @endphp
                                        <div class="col-sm-1 col-xs-3 float-left">
                                            <img src="{{$product->thumb[0]}}" alt="">
                                        </div>
                                        <div class="col-sm-5 col-xs-9 details float-left d-flex justify-content-center align-items-center">
                                            <span>aspetur autodit autfugit</span>
                                        </div>
                                        <div class="col-sm-6 col-xs-12 qty float-left d-flex justify-content-center align-items-center">
                                            <div class="col-xs-5 col-sm-5 text-sm-right text-xs-left">{{number_format($color->price)}} VNĐ</div>
                                            <div class="col-xs-2 col-sm-2">{{$item['count']}}</div>
                                            <div class="col-xs-5 col-sm-5 text-sm-right bold">{{number_format($color->price * $item['count'])}} VNĐ</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <hr class="float-left w-100">
                            <table class="float-left w-100 mb-30">
                                <tbody>
                                    <tr class="font-weight-bold">
                                        <td><span class="text-uppercase">Total</span></td>
                                        <td class="text-right">{{number_format($cart->total_price)}} VNĐ</td>
                                    </tr>
                                </tbody></table>
                            <div id="order-details" class="float-left w-100">
                                <h3 class="h3 card-title">Order details:</h3>
                                <ul>
                                    <li>Name: <span class="font-weight-bold">{{$order->user_name}}</span></li>
                                    <li>Phone: <span class="font-weight-bold">{{$order->phone}}</span></li>
                                    <li>Email: <span class="font-weight-bold">{{$order->email}}</span></li>
                                    <li>Address: <span class="font-weight-bold">{{$order->address}}</span></li>
                                    <li>
                                        Shipping method: Demo Store<br>
                                        <em>Pick up in-store</em>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
