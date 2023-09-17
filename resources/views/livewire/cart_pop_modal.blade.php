<!-- cart-pop modal -->
<div id="cart-dropdown" class="cart-menu min-w-100">
    @php
        if ($cart && $cart->count()){
            $total_price = $cart->total_price;
            $products = $cart->content;
        }
    @endphp
    <ul class="float-left">
        <li>
            <table class="table table-striped">
                <tbody>
                @if(isset($products))
                    @foreach($products as $product)
                        <tr>
                            <td class="text-left product-name"><a href="#">{{\App\Models\Product::where('id', $product['product_id'])->first()->name}}</a>
                                <div class="quantity float-left w-100">
                                    <span class="cart-qty">{{$product['count']}} × </span>
                                    <span class="text-left price"> {{number_format($product['price'])}} <span> VNĐ</span></span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </li>
        <li>
            <table class="table price mb-30">
                <tbody>
                <tr>
                    <td class="text-left"><strong>Tổng</strong></td>
                    <td class="text-right"><strong>{{number_format($total_price ?? null)}}<span> VNĐ</span></strong></td>
                </tr>
                </tbody>
            </table>
        </li>
        <li class="buttons">
            <form class="w-100 flex flex-row align-items-center" action="{{ route('client.checkout') }}">
                <input class="btn pull-right mt_10 btn-primary btn-rounded w-100" value="Đặt Hàng" type="submit">
            </form>
        </li>
    </ul>
</div>
