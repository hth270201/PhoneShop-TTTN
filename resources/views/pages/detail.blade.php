@extends('index')

@section('contents')
    @php
        $images = $product->thumb;
        $colors = $product->colors()->get()->toArray();
        $active = $product->colors()->first();
    @endphp
    <nav aria-label="breadcrumb" class="w-100 float-left">
        <ol class="breadcrumb parallax justify-content-center" data-source-url="img/banner/parallax.jpg" style="background-image: url(&quot;img/banner/parallax.jpg&quot;); background-position: 50% 0.809717%;">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Shop</li>
        </ol>
    </nav>
    <div class="product-deatils-section float-left w-100">
        <div class="container">
            <div class="row">
                <div class="left-columm col-lg-12 col-md-12 mb-50">
                    <div class="extended small-image-list float-left w-100 float-left">
                        <div class="nav-add small-image-slider-single-product-tabstyle-3 owl-carousel" role="tablist">
                            @php
                                $count = count($images);
                            @endphp
                            <div class="single-small-image img-full">
                                <a data-toggle="tab" id="product-tab-01" href="#" class="img"><img style="height: 300px" src="{{$images[0]}}" class="img-fluid" alt=""></a>
                            </div>
                            @if($count > 1)
                                @for($i=1; $i < $count; $i++)
                                    <div class="single-small-image img-full">
                                        <a data-toggle="tab" id="product-tab-0{{$i}}" href="#" class="img"><img style="height: 300px" src="{{$images[$i]}}" class="img-fluid" alt=""></a>
                                    </div>
                                @endfor
                            @endif
                        </div>
                    </div>

                </div>
                <div class="right-columm col-lg-12 col-md-12 text-center float-left">
                    <div class="product-information">
                        <h4 class="product-title text-capitalize float-left w-100"><a href="#" class="float-left w-100">{{$product->name}}</a></h4>
                        <div class="description">
                            <div class="row">
                                @foreach($product->description as $key => $item)
                                    <div class="col-md-6">
                                        <span><b>{{$key}}</b></span> {{$item}}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="rating">
                            <div class="product-ratings d-inline-block align-middle">
                                @for($i=1; $i <= intval($product->rate); $i++)
                                    <span class="fa fa-stack"><i class="material-icons">star</i></span>
                                @endfor
                            </div>
                            <a href="#" class="review-down">(customer reviews)</a>
                        </div>

                        <div class="price float-none w-100 d-inline-block">
                            <div class="regular-price d-inline-block"><span id="color_price">{{number_format($active->price)}}</span><span> VNĐ</span></div>
                        </div>

                        <div class="d-inline-block w-100 align-items-center mb-15 ">

                            <div class="product-variants d-inline-block mr-10 mb-xs-10">
                                <div class="color-option d-flex align-items-center">
                                    <h5>color :</h5>
                                    <ul class="color-categories">
                                        <li class="text-center" style="border: 1px solid {{$active->color_code}}; border-radius: 0; margin: 50px; width: 100px; background-color: {{$active->color_code}}">
                                            <a style="width: 100%" class="text-center color_price" href="#" data-color="{{$active->id}}"><b>{{$active->color}}</b></a>
                                        </li>
                                        @if(count($colors) > 1)
                                            @for($i = 1; $i < count($colors); $i++)
                                                <li class="text-center" style="border: 1px solid {{$colors[$i]['color_code']}}; border-radius: 0; margin: 50px; width: 100px; background-color: {{$colors[$i]['color_code']}}">
                                                    <a style="width: 100%" class="text-center color_price" href="#" data-color="{{$colors[$i]['id']}}"><b>{{$colors[$i]['color']}}</b></a>
                                                </li>
                                            @endfor
                                        @endif
                                    </ul>
                                    <script>
                                        $(document).ready(function() {
                                            $('.color_price').click(function() {
                                                var color_id = $(this).data('color');
                                                $.ajax({
                                                    url: '{{ route("client.detail.color", ":color_id") }}'.replace(':color_id', color_id),
                                                    type: 'GET',
                                                    dataType: 'json',
                                                    success: function(response) {
                                                        if (response) {
                                                            console.log(response.price);
                                                            $('#color_price').html(response.price);
                                                        } else {
                                                            console.log("ERROR");
                                                        }
                                                    },
                                                    error: function() {
                                                        console.log("ERORRRRRR");
                                                    }
                                                });
                                                return false;
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="btn-cart m-0 d-inline-block">
                                <div class="quantity d-flex float-left align-items-center">
                                    <h5>qty:</h5>
                                    <input value="1" type="number">
                                </div>
                                <button type="button" class="btn btn-primary btn-cart m-0" data-target="#cart-pop" data-toggle="modal"><i class="material-icons">shopping_cart</i> Add To Cart</button>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container">
        {!! $product->detail !!}
    </div>
@endsection
