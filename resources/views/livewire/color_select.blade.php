<div class="product-variants d-flex flex-row justify-content-around mr-10 mb-xs-10">
    @if(count($product->colors) >= 1)
        @foreach($product->colors as $color)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{number_format($color->price)}}<span> VNĐ</span></h5>
                    <p class="card-text">{{$color->color}}</p>
                    <button @if($color->count == 0) {{"disabled"}} @endif  wire:click="check({{$color}})" data-target="#cart-pop" data-toggle="modal"
                            style="background-color: {{$color->color_code}}" class="btn">Add to cart
                    </button>
                </div>
            </div>
        @endforeach
    @endif
</div>
