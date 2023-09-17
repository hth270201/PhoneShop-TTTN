<div class="slider-wrapper my-40 my-sm-25 float-left w-100">
    <div class="container">
        <div class="fixed right-10 top-30 w-11/12 md:w-auto flex flex-col gap-2 z-[99]">
            @if(session('error'))
                <div>
                    <p class="font-normal text-xs md:text-sm lg:text-base px-4 py-4  md:p-2 lg:p-5 rounded-4xl bg-primary text-white">
                        {{session('error')}}
                    </p>
                </div>
            @endif
        </div>
        <div class="ttloading-bg"></div>
        <div class="slider slider-for owl-carousel">
            <div>
                <a href="#">
                    <img src="img/slider/sample-01.jpg" alt="" height="800" width="1600"/>
                </a>
                <div class="slider-content-wrap center effect_top">
                    <div class="slider-title mb-20 text-capitalize float-left w-100">our specials</div>
                    <div class="slider-subtitle mb-50 text-capitalize float-left w-100">fashion trend</div>
                    <div class="slider-button text-uppercase float-left w-100"><a href=" #">Shop Now</a></div>
                </div>
            </div>
            <div>
                <a href="#">
                    <img src="img/slider/sample-02.jpg" alt="" height="800" width="1600"/>
                </a>
                <div class="slider-content-wrap center effect_bottom">
                    <div class="slider-title mb-20 text-capitalize float-left w-100">about us</div>
                    <div class="slider-subtitle mb-50 text-capitalize float-left w-100">fashion style</div>
                    <div class="slider-button text-uppercase float-left w-100"><a href=" #">Shop Now</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
