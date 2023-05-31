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

    <div class="product-tab-area float-left w-100">
        <div class="container-fluid">
            <div class="tabs">
                <ul class="nav nav-tabs justify-content-center">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#product-tab1" id="tab1"><div class="tab-title">Description</div></a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#product-tab2" id="tab2"><div class="tab-title">Reviews (2)</div></a></li>
                </ul>
            </div>
            <div class="tab-content float-left w-100">
                <div class="tab-pane active" id="product-tab1" role="tabpanel" aria-labelledby="tab1">
                    <div class="description text-center">
                        <div class="ttbanner float-left w-100 d-flex d-lg-flex d-md-flex d-sm-flex d-xs-block align-items-center bg-dark">
                            <div class="column-left col-sm-6 p-0">
                                <img src="img/banner/left-img.jpg" alt="left-img"/>
                            </div>
                            <div class="column-right col-sm-6 p-0">
                                <h1 class="d-inline-block w-80 float-none">Lorem ipsum dolor sit amet</h1>
                                <p>2019 fashion</p>
                            </div>
                        </div>
                        <div class="ttcmsbanner float-left w-100 d-flex d-lg-flex d-md-flex d-sm-flex d-xs-block align-items-center bg-light p-70">
                            <div class="col-left col-sm-4 float-left">
                                <div class="inner-content text-left mb-100">
                                    <h4 class="text-dark">Raw Material</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce gravida velit neque, a feugiat lectus porta eget. Pellentesque cursus, nunc congue viverra blandit, eros arcu dapibus leo, quis congue ipsum ipsum non ante.</p>
                                </div>
                                <div class="inner-content text-left">
                                    <h4 class="text-dark">Raw Material</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce gravida velit neque, a feugiat lectus porta eget. Pellentesque cursus, nunc congue viverra blandit, eros arcu dapibus leo, quis congue ipsum ipsum non ante.</p>
                                </div>
                            </div>
                            <div class="col-middle col-sm-4 float-left">
                                <img src="img/banner/ext-img.png" alt="ext-img"/>
                            </div>
                            <div class="col-right col-sm-4 float-right">
                                <div class="inner-content text-right mb-100">
                                    <h4 class="text-dark">Raw Material</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce gravida velit neque, a feugiat lectus porta eget. Pellentesque cursus, nunc congue viverra blandit, eros arcu dapibus leo, quis congue ipsum ipsum non ante.</p>
                                </div>
                                <div class="inner-content text-right">
                                    <h4 class="text-dark">Raw Material</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce gravida velit neque, a feugiat lectus porta eget. Pellentesque cursus, nunc congue viverra blandit, eros arcu dapibus leo, quis congue ipsum ipsum non ante.</p>
                                </div>
                            </div>

                        </div>
                        <div class="ttcmsparallax float-left w-100">
                            <div class="parallax" data-source-url="img/banner/inner-parallax.jpg" style="background-image:url(img/banner/inner-parallax.jpg); background-position:50% 65.8718%;">
                                <div class="ttparallax-content">
                                    <h1 class="text-capitalize">latest fashion trends 2019</h1>
                                </div>
                            </div>
                        </div>

                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/G_yaJjmwtZc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="product-tab2" role="tabpanel" aria-labelledby="tab2">
                    <div class="reviews-tab  float-left w-100">
                        <div class="ttreview-tab float-left w-100 p-30">
                            <h2>Customer Reviews</h2>
                            <div class="rating float-left w-100">
                                <div class="product-ratings d-inline-block align-middle">
                                    <span class="fa fa-stack"><i class="material-icons">star</i></span>
                                    <span class="fa fa-stack"><i class="material-icons">star</i></span>
                                    <span class="fa fa-stack"><i class="material-icons">star</i></span>
                                    <span class="fa fa-stack"><i class="material-icons off">star</i></span>
                                    <span class="fa fa-stack"><i class="material-icons off">star</i></span>
                                </div>
                            </div>
                            <div class="review-title float-left w-100"><span class="user">admin</span> <span class="date">– February 14, 2019</span></div>
                            <div class="review-desc  float-left w-100">Aliquam at ipsum tellus. Donec arcu est, posuere quis orci vel, commodo cursus augue. </div>
                        </div>
                        <form action="#" class="rating-form float-left w-100">
                            <h5>Add your rating</h5>
                            <div class="rating">
                                <div class='rating-stars text-left'>
                                    <ul id='stars'>
                                        <li class='star' title='Poor' data-value='1'>
                                            <i class="material-icons">star</i>
                                        </li>
                                        <li class='star' title='Fair' data-value='2'>
                                            <i class="material-icons">star</i>
                                        </li>
                                        <li class='star' title='Good' data-value='3'>
                                            <i class="material-icons">star</i>
                                        </li>
                                        <li class='star' title='Excellent' data-value='4'>
                                            <i class="material-icons">star</i>
                                        </li>
                                        <li class='star' title='WOW!!!' data-value='5'>
                                            <i class="material-icons">star</i>
                                        </li>
                                    </ul>
                                </div>
                                <div class='success-box'>
                                    <div class='clearfix'></div>
                                    <div class='text-message text-success'></div>
                                    <div class='clearfix'></div>
                                </div>
                            </div>
                            <div class="row d-block">

                                <div class="col-sm-6 float-left form-group">
                                    <label>Name <span class="required">*</span></label>
                                    <input type="text" placeholder="" required="">
                                </div>
                                <div class="col-sm-6 float-left form-group">
                                    <label>Email <span class="required">*</span></label>
                                    <input type="email" placeholder="" id="r-email" required>
                                </div>
                                <div class="col-sm-12 float-left form-group">
                                    <label for="r-textarea">Your Review</label>
                                    <textarea name="review" id="r-textarea" cols="30" rows="10" class="w-100"></textarea>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary submit" value="Submit Review">
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div id="product-accessories" class="product-accessories my-40 w-100 float-left">
        <div class="container">
            <div class="row">
                <div class="tt-title d-inline-block float-none w-100 text-center">You might also like</div>
                <div class="product-accessories-content products grid owl-carousel">
                    <div class="product-layouts">
                        <div class="product-thumb">
                            <div class="image zoom">
                                <a href="product-details.html">
                                    <img src="img/products/01.jpg" alt="01"/>
                                    <img src="img/products/02.jpg" alt="02" class="second_image img-responsive"/>										</a>									</div>
                            <div class="thumb-description">
                                <div class="caption">
                                    <h4 class="product-title text-capitalize"><a href="product-details.html">aliquam quaerat voluptatem</a></h4>
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
                                    <div class="regular-price">$100.00</div>
                                    <div class="old-price">$150.00</div>
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
                    <div class="product-layouts">
                        <div class="product-thumb">
                            <div class="image zoom">
                                <a href="product-details.html">
                                    <img src="img/products/02.jpg" alt="02"/>
                                    <img src="img/products/03.jpg" alt="03" class="second_image img-responsive"/>									</a>									</div>
                            <div class="thumb-description">
                                <div class="caption">
                                    <h4 class="product-title text-capitalize"><a href="product-details.html">aspetur autodit autfugit</a></h4>
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
                                    <div class="regular-price">$100.00</div>
                                    <div class="old-price">$150.00</div>
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
                    <div class="product-layouts">
                        <div class="product-thumb">
                            <div class="image zoom">
                                <a href="product-details.html">
                                    <img src="img/products/03.jpg" alt="03"/>
                                    <img src="img/products/04.jpg" alt="04" class="second_image img-responsive"/>
                                </a>
                            </div>
                            <div class="thumb-description">
                                <div class="caption">
                                    <h4 class="product-title text-capitalize"><a href="product-details.html">magni dolores eosquies</a></h4>
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
                                    <div class="regular-price">$100.00</div>
                                    <div class="old-price">$150.00</div>
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
                    <div class="product-layouts">
                        <div class="product-thumb">
                            <div class="image zoom">
                                <a href="product-details.html">
                                    <img src="img/products/04.jpg" alt="04"/>
                                    <img src="img/products/05.jpg" alt="05" class="second_image img-responsive"/>										</a>									</div>
                            <div class="thumb-description">
                                <div class="caption">
                                    <h4 class="product-title text-capitalize"><a href="product-details.html">voluptas nulla pariatur</a></h4>
                                </div>
                                <div class="rating">
                                    <div class="product-ratings d-inline-block align-middle">
                                        <span class="fa fa-stack"><i class="material-icons">star</i></span>
                                        <span class="fa fa-stack"><i class="material-icons">star</i></span>
                                        <span class="fa fa-stack"><i class="material-icons">star</i></span>
                                        <span class="fa fa-stack"><i class="material-icons off">star</i></span>
                                        <span class="fa fa-stack"><i class="material-icons off">star</i></span>
                                    </div>								</div>
                                <div class="price">
                                    <div class="regular-price">$100.00</div>
                                    <div class="old-price">$150.00</div>
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
                    <div class="product-layouts">
                        <div class="product-thumb">
                            <div class="image zoom">
                                <a href="product-details.html">
                                    <img src="img/products/05.jpg" alt="05"/>
                                    <img src="img/products/06.jpg" alt="06" class="second_image img-responsive"/>										</a>									</div>
                            <div class="thumb-description">
                                <div class="caption">
                                    <h4 class="product-title text-capitalize"><a href="product-details.html">aliquam quat voluptatem</a></h4>
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
                                    <div class="regular-price">$100.00</div>
                                    <div class="old-price">$150.00</div>
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
                    <div class="product-layouts">
                        <div class="product-thumb">
                            <div class="image zoom">
                                <a href="product-details.html">
                                    <img src="img/products/06.jpg" alt="06"/>
                                    <img src="img/products/07.jpg" alt="07" class="second_image img-responsive"/>												</a>									</div>
                            <div class="thumb-description">
                                <div class="caption">
                                    <h4 class="product-title text-capitalize"><a href="product-details.html">voluptas sit aspernatur</a></h4>
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
                                    <div class="regular-price">$100.00</div>
                                    <div class="old-price">$150.00</div>
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
                </div>
            </div>
        </div>
    </div>
@endsection
