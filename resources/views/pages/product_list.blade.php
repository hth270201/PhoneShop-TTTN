@extends('index')

@section('contents')
    <ol class="breadcrumb parallax justify-content-center" data-source-url="img/banner/parallax.jpg" style="background-image: url(&quot;img/banner/parallax.jpg&quot;); background-position: 50% 0.809717%;">
        <li class="breadcrumb-item"><a href="{{route('client.home')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">List</li>
    </ol>
    </nav>
    <div class="main-content w-100 float-left">
        <div class="container">
            <div class="row">
                <div class="content-wrapper col-xl-12 col-lg-12 order-lg-2">
                    <header class="product-grid-header d-flex d-xs-block d-sm-flex d-lg-flex w-100 float-left">
                        <div class="hidden-sm-down total-products d-flex d-xs-block d-lg-flex col-md-3 col-sm-3 col-xs-12 align-items-center">
                            <div class="row">
                                <div class="nav" role="tablist">
                                    <a class="grid active" href="#grid" data-toggle="tab" role="tab" aria-selected="true" aria-controls="grid"><i class="material-icons align-middle">grid_on</i></a>
                                </div>
                            </div>
                        </div>
                        <div class="shop-results-wrapper d-flex d-sm-flex d-xs-block d-lg-flex justify-content-end col-md-9 col-sm-9 col-xs-12">
                            <div class="shop-results d-flex align-items-center"><span>Sort By</span>
                                <div class="shop-select">
                                    <select name="sort" id="sort">
                                        <option value="position">Default sorting</option>
                                        <option value="p-name">Sort Popularity</option>
                                        <option value="p-price">Sort Price</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </header>
                    <div class="tab-content text-center products w-100 float-left category-col-6">
                        <div class="tab-pane grid fade active" id="grid" role="tabpanel">
                            <div class="row">
                                @foreach($products as $product)
                                    @php
                                        $images = $product->thumb;
                                        $colors = $product->colors()->get()->toArray();
                                        $active = $product->colors()->first();
                                    @endphp
                                    <div class="product-layouts col-lg-2 col-md-2 col-sm-6 col-xs-6">
                                        <div class="product-thumb">
                                            <div class="image zoom">
                                                <a href="{{route('client.detail', $product->slug)}}">
                                                    <img src="{{$images[0]}}" alt="{{$product->name}}" style="height: 200px"/>
                                                    @if(count($images) >= 2)
                                                        <img src="{{$images[1]}}" alt="{{$product->name}}" class="second_image img-responsive"/>
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="thumb-description">
                                                <div class="caption">
                                                    <h6 class="product-title text-capitalize"><a style="font-size: 13px" href="{{route('client.detail', $product->slug)}}">{{$product->name}}</a></h6>
                                                </div>
                                                <div class="rating">
                                                    <div class="product-ratings d-inline-block align-middle">
                                                        @for($i=1; $i <= intval($product->rate); $i++)
                                                            <span class="fa fa-stack"><i class="material-icons">star</i></span>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <div class="price">
                                                    <div class="regular-price">{{number_format($active->price)}} <span> VNĐ</span></div>
                                                </div>
                                                <div class="button-wrapper">
                                                    <div class="button-group text-center">
                                                        <button type="button" class="btn btn-primary btn-cart" data-target="#cart-pop" data-toggle="modal"><i class="material-icons">shopping_cart</i><span>Add to cart</span></button>
                                                        <a href="wishlist.html" class="btn btn-primary btn-wishlist"><i class="material-icons">favorite</i><span>wishlist</span></a>
                                                        <button type="button" class="btn btn-primary btn-compare"><i class="material-icons">equalizer</i><span>Compare</span></button>
                                                        <button type="button" class="btn btn-primary btn-quickview"  data-toggle="modal" data-target="#product_view"><i class="material-icons">visibility</i><span>Quick View</span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="pagination-wrapper float-left w-100">
                        <p>Showing 1 to 9 of 11 (2 Pages)</p>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
