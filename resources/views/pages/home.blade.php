@extends('index')

@section('contents')
    <div class="main-content">
        <div id="main">
            <div id="hometab" class="home-tab my-40 my-sm-25 bottom-to-top hb-animate-element">
                <div class="container">
                    <div class="row">
                        <div class="tt-title d-inline-block float-none w-100 text-center">Sản Phẩm Đánh Giá Cao</div>
                        <div class="tab-content float-left w-100">
                            <div class="tab-pane active float-left w-100" id="ttfeatured-main" role="tabpanel" aria-labelledby="featured-tab">
                                <section id="ttfeatured" class="ttfeatured-products">
                                    <div class="ttfeatured-content products grid owl-carousel" id="owl1">
                                        @if($top_product)
                                            @foreach($top_product as $product)
                                                <div class="product-layouts">
                                                    <div class="product-thumb">
                                                        <div class="image zoom">
                                                            <a href={{ route('client.detail', $product->slug) }}>
                                                                @php
                                                                    $images = $product->thumb;
                                                                @endphp
                                                                <img src="{{$images[0]}}" alt="01" style="height: 500px"/>
                                                                @if(count($images) >= 2)
                                                                    <img src="{{$images[1]}}" alt="02" class="second_image img-responsive" style="height: 500px; background-color: #ffffff"/>
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="thumb-description">
                                                            <div class="caption">
                                                                <h4 class="product-title text-capitalize"><a href={{ route('client.detail', $product->slug) }}>{{$product->name}}</a></h4>
                                                            </div>
                                                            <div class="rating">
                                                                <div class="product-ratings d-inline-block align-middle">
                                                                    <span class="fa fa-stack"><i class="material-icons">star</i></span>
                                                                    <span class="fa fa-stack"><i class="material-icons">star</i></span>
                                                                    <span class="fa fa-stack"><i class="material-icons">star</i></span>
                                                                    <span class="fa fa-stack"><i class="material-icons off">star</i></span>
                                                                    <span class="fa fa-stack"><i class="material-icons off">star</i></span>
                                                                </div>
                                                            </div>
                                                            <div class="price">
                                                                <div class="regular-price">{{number_format($product->price)}}</div>
                                                            </div>
                                                            <div class="button-wrapper">
                                                                <div class="button-group text-center">
                                                                    <a href="/{{$product->slug}}" type="button" class="btn btn-primary btn-cart" data-target="#cart-pop" data-toggle="modal"><i class="material-icons">shopping_cart</i><span>Add to cart</span></a>
                                                                    <a href="#" class="btn btn-primary btn-wishlist"><i class="material-icons">favorite</i><span>wishlist</span></a>
                                                                    <button type="button" class="btn btn-primary btn-compare"><i class="material-icons">equalizer</i><span>Compare</span></button>
                                                                    <button type="button" class="btn btn-primary btn-quickview"  data-toggle="modal" data-target="#product_view"><i class="material-icons">visibility</i><span>Quick View</span></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="ttspecial" class="ttspecial my-40 bottom-to-top hb-animate-element">
                <div class="container">
                    <div class="row">
                        <div class="tt-title d-inline-block float-none w-100 text-center">Sản Phẩm Liên Quan</div>
                        <div class="ttspecial-content products grid owl-carousel">
                            @if($releated_product)
                                @foreach($releated_product as $product)
                                    <div class="product-layouts">
                                        <div class="product-thumb">
                                            <div class="image zoom">
                                                <a href="{{ route('client.detail', $product->slug) }}">
                                                    @php
                                                        $images = $product->thumb;
                                                    @endphp
                                                    <img src="{{$images[0]}}" alt="01" style="height: 500px"/>
                                                    @if(count($images) >= 2)
                                                        <img src="{{$images[1]}}" alt="02" class="second_image img-responsive" style="height: 500px; background-color: #ffffff"/>
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="thumb-description">
                                                <div class="caption">
                                                    <h4 class="product-title text-capitalize"><a href="{{ route('client.detail', $product->slug) }}">{{$product->name}}</a></h4>
                                                </div>
                                                <div class="rating">
                                                    <div class="product-ratings d-inline-block align-middle">
                                                        <span class="fa fa-stack"><i class="material-icons">star</i></span>
                                                        <span class="fa fa-stack"><i class="material-icons">star</i></span>
                                                        <span class="fa fa-stack"><i class="material-icons">star</i></span>
                                                        <span class="fa fa-stack"><i class="material-icons off">star</i></span>
                                                        <span class="fa fa-stack"><i class="material-icons off">star</i></span>
                                                    </div>
                                                </div>
                                                <div class="price">
                                                    <div class="regular-price">{{number_format($product->price)}}</div>
                                                </div>
                                                <div class="button-wrapper">
                                                    <div class="button-group text-center">
                                                        <button type="button" class="btn btn-primary btn-cart" data-target="#cart-pop" data-toggle="modal" disabled="disabled"><i class="material-icons">shopping_cart</i><span>Add to cart</span></button>
                                                        <a href="#" class="btn btn-primary btn-wishlist"><i class="material-icons">favorite</i><span>wishlist</span></a>
                                                        <button type="button" class="btn btn-primary btn-compare"><i class="material-icons">equalizer</i><span>Compare</span></button>
                                                        <button type="button" class="btn btn-primary btn-quickview"  data-toggle="modal" data-target="#product_view"><i class="material-icons">visibility</i><span>Quick View</span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div id="ttbrandlogo" class="my-40 my-sm-25 bottom-to-top hb-animate-element">
                <div class="container">
                    <div class="tt-brand owl-carousel">
                        <div class="item">
                            <a href="#"><img src="img/logos/brand-logo-01.png" alt="brand-logo-01" width="140" height="100"></a>
                        </div>
                        <div class="item">
                            <a href="#"><img src="img/logos/brand-logo-02.png" alt="brand-logo-02" width="140" height="100"></a>
                        </div>
                        <div class="item">
                            <a href="#"><img src="img/logos/brand-logo-03.png" alt="brand-logo-03" width="140" height="100"></a>
                        </div>
                        <div class="item">
                            <a href="#"><img src="img/logos/brand-logo-04.png" alt="brand-logo-04" width="140" height="100"></a>
                        </div>
                        <div class="item">
                            <a href="#"><img src="img/logos/brand-logo-05.png" alt="brand-logo-05" width="140" height="100"></a>
                        </div>
                        <div class="item">
                            <a href="#"><img src="img/logos/brand-logo-06.png" alt="brand-logo-06" width="140" height="100"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
