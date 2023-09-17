@extends('index')

@section('contents')
    @php
        $images = $product->thumb;
        $colors = $product->colors()->get()->toArray();
        $active = $product->colors()->first();
    @endphp
    <nav aria-label="breadcrumb" class="w-100 float-left">
        <ol class="breadcrumb parallax justify-content-center" data-source-url="img/banner/parallax.jpg" style="background-image: url(&quot;img/banner/parallax.jpg&quot;); background-position: 50% 0.809717%;">
            <li class="breadcrumb-item"><a href="#">Trang Chủ</a></li>
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
                            @livewire('color', ['product' => $product])
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
