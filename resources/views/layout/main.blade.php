<div class="header-main-head">

    <div class="header-main">
        <div class="container">
            <div class="header-left float-left d-flex d-lg-flex d-md-block d-xs-block">
                <div class="contact">
                    <i class="material-icons">phone</i>
                    <a href="tel:+1234567890">1234567890</a>
                </div>
            </div>
            <div class="header-middle float-lg-left float-md-left float-sm-left float-xs-none">
                <div class="logo">
                    <a href={{ route('client.home') }}><img src={{ asset('img/logos/logo.png') }} alt="logo" width="200" height="50" ></a>		</div>
            </div>
            <div class="header-right d-flex d-xs-flex d-sm-flex justify-content-end float-right">
                <div class="search-wrapper">
                    <a>
                        <i class="material-icons search">search</i>
                        <i class="material-icons close">close</i>			</a>
                    <form autocomplete="off" action="{{route('client.search')}}" method="POST" class="search-form">
                        @csrf
                        <div class="autocomplete">
                            <input id="search" type="text" name="search" placeholder="Search here">
                            <button type="submit"><i class="material-icons">search</i></button>
                        </div>
                    </form>
                </div>
                <div class="user-info">
                    <button type="button" class="btn">
                        <i class="material-icons">perm_identity</i>		</button>
                    <div id="user-dropdown" class="user-menu">
                        <ul>
                            @if(\Illuminate\Support\Facades\Auth::user())
                                <li><a href="#" class="text-capitalize">My account</a></li>
                                <li><a href="{{ route('client.logout') }}" class="modal-view button">Logout</a></li>
                            @else
                                <li><a href="{{ route('register') }}" class="modal-view button" >Register</a></li>
                                <li><a href="{{ route('login') }}" class="modal-view button">Login</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="cart-wrapper">
                    <button type="button" class="btn">
                        <i class="material-icons">shopping_cart</i>
                    @livewire("cart")
                </div>
            </div>
        </div>
    </div>
    <div class="menu">
        <div class="container">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light d-sm-none d-xs-none d-lg-block navbar-full">

                <!-- Navbar brand -->
                <a class="navbar-brand text-uppercase d-none" href="#">Navbar</a>

                <!-- Collapse button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent2"
                        aria-controls="navbarSupportedContent2" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Collapsible content -->
                <div class="collapse navbar-collapse">

                    <!-- Links -->
                    <ul class="navbar-nav m-auto justify-content-center">
                        <li class="nav-item dropdown active">
                            <a class="nav-link text-uppercase" href="{{route('client.home')}}">
                                Trang Chủ
                            </a>
                        </li>
                        <li class="nav-item dropdown mega-dropdown">
                            <a class="nav-link text-uppercase" href="{{route('client.list.show'). '?sort=default'}}">Danh Sách Sản Phẩm</a>
                        </li>
                    </ul>
                    <!-- Links -->
                </div>
                <!-- Collapsible content -->

            </nav>
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light d-lg-none navbar-responsive">

                <!-- Navbar brand -->
                <a class="navbar-brand text-uppercase d-none" href="#">Navbar</a>

                <!-- Collapse button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent2"
                        aria-controls="navbarSupportedContent2" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class='material-icons'>sort</i></span>
                </button>

                <!-- Collapsible content -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent2">

                    <!-- Links -->
                    <ul class="navbar-nav m-auto justify-content-center">

                        <!-- Features -->
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle text-uppercase" data-toggle="collapse" data-target="#menu1"
                               aria-controls="menu1" aria-expanded="false" aria-label="Toggle navigation" href="#">
                                Trang Chủ
                                <span class="sr-only">(current)</span>        </a>
                            <div class="dropdown-menu mega-menu v-2 z-depth-1 special-color py-3 px-3" id="menu1">
                                <div class="sub-menu mb-xl-0 mb-4">
                                    <ul class="list-unstyled">
                                        <li>
                                            <a class="menu-item pl-0" href="index.html">
                                                Home 1                  </a>                </li>
                                        <li>
                                            <a class="menu-item pl-0" href="index2.html">
                                                Home 2                  </a>                </li>
                                        <li>
                                            <a class="menu-item pl-0" href="index3.html">
                                                Home 3                 </a>                </li>
                                        <li>
                                            <a class="menu-item pl-0" href="index4.html">
                                                Home 4                  </a>                </li>
                                        <li>
                                            <a class="menu-item pl-0" href="index5.html">
                                                Home 5                  </a>                </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown mega-dropdown">
                            <a class="nav-link dropdown-toggle text-uppercase" data-toggle="collapse" data-target="#menu3"
                               aria-controls="menu3" aria-expanded="false" aria-label="Toggle navigation" href="#">Category</a>
                            <div class="dropdown-menu mega-menu v-2 z-depth-1 special-color py-3 px-3" id="menu3">
                                <div class="row">
                                    <div class="col-md-12 col-xl-4 sub-menu mb-xl-0 mb-4">
                                        <h6 class="sub-title text-uppercase font-weight-bold white-text">Variation 1</h6>
                                        <!--Featured image-->
                                        <ul class="list-unstyled">
                                            <li>
                                                <a class="menu-item pl-0" href="filter-toggle.html">
                                                    filter toggle                  </a>                </li>
                                            <li>
                                                <a class="menu-item pl-0" href="off-canvas-left.html">
                                                    off canvas left                </a>                </li>
                                            <li>
                                                <a class="menu-item pl-0" href="off-canvas-right.html">
                                                    off canvas right                </a>                </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6 col-xl-4 sub-menu mb-md-0 mb-4">
                                        <h6 class="sub-title text-uppercase font-weight-bold white-text">Variation 2</h6>
                                        <ul class="list-unstyled">
                                            <li>
                                                <a class="menu-item pl-0" href="category-5-col.html">
                                                    grid 5 column                 </a>                </li>
                                            <li>
                                                <a class="menu-item pl-0" href="category-6-col.html">
                                                    grid 6 column                  </a>                </li>
                                            <li>
                                                <a class="menu-item pl-0" href="category-7-col.html">
                                                    grid 7 column                   </a>                </li>
                                            <li>
                                                <a class="menu-item pl-0" href="category-8-col.html">
                                                    grid 8 column                </a>                </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6 col-xl-4 sub-menu mb-0">

                                        <ul class="list-unstyled">
                                            <li>
                                                <span class="menu-banner"><img src="img/banner/menu-banner.jpg" alt="menu-banner" width="210" height="300"/></span>                </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-uppercase" data-toggle="collapse" data-target="#menu2"
                               aria-controls="menu2" aria-expanded="false" aria-label="Toggle navigation" href="#">
                                Shop
                                <span class="sr-only">(current)</span>        </a>
                            <div class="dropdown-menu mega-menu v-2 z-depth-1 special-color py-3 px-3" id="menu2">
                                <div class="sub-menu mb-xl-0 mb-4">
                                    <h6 class="sub-title text-uppercase font-weight-bold white-text">Featured</h6>
                                    <ul class="list-unstyled">
                                        <li>
                                            <a class="menu-item pl-0" href="product-grid.html">
                                                product grid                </a>                </li>
                                        <li>
                                            <a class="menu-item pl-0" href="product-sticky-right.html">
                                                sticky right                  </a>                </li>
                                        <li>
                                            <a class="menu-item pl-0" href="product-extended-layout.html">
                                                Extended layout                 </a>                </li>
                                        <li>
                                            <a class="menu-item pl-0" href="product-details.html">
                                                Default layout                </a>                </li>
                                        <li>
                                            <a class="menu-item pl-0" href="product-compact.html">
                                                compact layout           </a>                </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <!-- Technology -->



                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-uppercase"  data-toggle="collapse" data-target="#menu4"
                               aria-controls="menu4" aria-expanded="false" aria-label="Toggle navigation" href="#">Blog</a>
                            <div class="dropdown-menu mega-menu v-2 z-depth-1 special-color py-3 px-3" id="menu4">
                                <div class="sub-menu">
                                    <h6 class="sub-title text-uppercase font-weight-bold white-text d-none">Featured</h6>
                                    <ul class="list-unstyled">
                                        <li>
                                            <a class="menu-item pl-0" href="blog-2-column.html">
                                                blog 2 column                  </a>                </li>
                                        <li>
                                            <a class="menu-item pl-0" href="blog-3-column.html">
                                                blog 3 column                  </a>                </li>
                                        <li>
                                            <a class="menu-item pl-0" href="blog-2-column-masonary.html">
                                                blog masonary                 </a>                </li>
                                        <li>
                                            <a class="menu-item pl-0" href="blog-list.html">
                                                blog list                  </a>                </li>
                                        <li>
                                            <a class="menu-item pl-0" href="blog-details.html">
                                                blog details                  </a>                </li>
                                    </ul>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link text-uppercase" href="contact-us.html">contact us</a>      </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-uppercase"  data-toggle="collapse" data-target="#menu5"
                               aria-controls="menu5" aria-expanded="false" aria-label="Toggle navigation" href="#">Pages</a>
                            <div class="dropdown-menu mega-menu v-2 z-depth-1 special-color py-3 px-3" id="menu5">
                                <div class="sub-menu">
                                    <h6 class="sub-title text-uppercase font-weight-bold white-text d-none">Featured</h6>
                                    <ul class="list-unstyled">
                                        <li>
                                            <a class="menu-item pl-0" href="about-us.html">
                                                About us                 </a>				 </li>
                                        <li>
                                            <a class="menu-item pl-0" href="accordions.html">
                                                Accordions                  </a>                </li>
                                        <li>
                                            <a class="menu-item pl-0" href="buttons.html">
                                                Buttons              </a>                </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <!-- Links -->
                </div>
                <!-- Collapsible content -->

            </nav>
        </div>
    </div>
</div>
