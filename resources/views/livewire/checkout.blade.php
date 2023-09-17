<div>
    <nav aria-label="breadcrumb" class="w-100 float-left">
        <ol class="breadcrumb parallax justify-content-center" data-source-url="img/banner/parallax.jpg" style="background-image: url(&quot;img/banner/parallax.jpg&quot;); background-position: 50% 0.809717%;">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"></li>

        </ol>
    </nav>
    <div class="cart-area table-area pt-110 pb-95 float-left w-100 mb-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 cart-wrapper">
                    <div class="table-responsive">
                        <table class="table product-table text-center">
                            <thead>
                            <tr>
                                <th class="table-remove text-capitalize">Xóa</th>
                                <th class="table-image text-capitalize">Hình ảnh</th>
                                <th class="table-p-name text-capitalize">Tên sản ph</th>
                                <th class="table-p-name text-capitalize">Màu Sắc</th>ẩm
                                <th class="table-p-price text-capitalize">Giá</th>
                                <th class="table-p-qty text-capitalize">Số lượng</th>
                                <th class="table-total text-capitalize">Tổng</th>
                                <th class="table-remove text-capitalize">Lưu</th>

                            </tr>
                            </thead>
                            <tbody>
                            @if($content)
                                @foreach($content as $key => $item)
                                    @php
                                        $product = \App\Models\Product::where('id', $item['product_id'])->first();
                                        $color = \App\Models\Color::where('id', $item['color_id'])->first();
                                    @endphp
                                    <tr>
                                        <td wire:click="removeProduct('{{ $key }}')" class="table-remove">
                                            <button><i class="material-icons">delete</i></button>
                                        </td>
                                        <td class="table-image"><a href="{{ route('client.detail', ['slug' => $product->slug]) }}"><img src="{{$product->thumb[0]}}" alt=""></a></td>
                                        <td class="table-p-name text-capitalize"><a href="{{ route('client.detail', ['slug' => $product->slug]) }}">{{$product->name}}</a></td>
                                        <td class="table-p-name text-capitalize">{{$color->color}}</td>
                                        <td class="table-p-price"><p>{{number_format($color->price)}}</p></td>
                                        <td wire:model="qty" class="table-p-qty"><input value="{{ $item['count'] }}" name="cart-qty" type="number" min="1"></td>
                                        <td class="table-p-price"><p>{{number_format($color->price * $item['count'])}}</p></td>
                                        <td class="table-remove">
                                            <button wire:click="qtyUpdate('{{$key}}')" class="btn btn-primary p-2">Lưu</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="checkout-inner float-left w-100 mt-5">
                    <div class="container">
                        <form wire:submit.prevent="order" method="POST">
                            <div class="row">
                                <div class="cart-block-left col-md-8">
                                    <h4 class="mb-3">Thông tin thanh toán</h4>
                                    <div class="needs-validation">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="user_name">Họ Tên <span class="required">*</span></label>
                                                <input wire:model="user_name" type="text" name="user_name" class="form-control" id="user_name" placeholder="" value="" required>
                                                <div class="invalid-feedback">
                                                    Valid first name is required.
                                                </div>
                                                @error('user_name') <span class="font-italic text-danger">{{$message}}</span> @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="phone">SĐT <span class="required">*</span></label>
                                                <input wire:model="phone" type="text" name="phone" class="form-control" id="phone" placeholder="" value="" required>
                                                <div class="invalid-feedback">
                                                    Valid phone is required.
                                                </div>
                                                @error('phone') <span class="font-italic text-danger">{{$message}}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="email">Email <span class="required">*</span></label>
                                            <input wire:model="email" type="email" name="email" class="form-control" id="email" placeholder="you@example.com" required>
                                            <div class="invalid-feedback">
                                                Please enter a valid email address for shipping updates.
                                            </div>
                                            @error('email') <span class="font-italic text-danger">{{$message}}</span> @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="address">Địa Chỉ<span class="required">*</span> </label>
                                            <input wire:model="address" type="text" name="address" class="form-control" id="address" placeholder="1234 Main St" required="">
                                            <div class="invalid-feedback">
                                                Please enter your shipping address.
                                            </div>
                                            @error('address') <span class="font-italic text-danger">{{$message}}</span> @enderror
                                        </div>
                                        </d>
                                    </div>
                                </div>
                                <div class="table-total-wrapper d-flex justify-content-end pt-60 col-md-12 col-sm-12 col-lg-4 float-left align-items-center">
                                    <div class="table-total-content">
                                        <h2 class="pb-20">Tổng Giỏ Hàng</h2>
                                        <div class="table-total-amount">
                                            <div class="single-total-content d-flex justify-content-between float-left w-100">
                                                <strong>Tổng Phụ</strong>
                                                <span class="c-total-price">{{number_format($cart->total_price)}} VNĐ</span>
                                            </div>
                                            <div class="single-total-content d-flex justify-content-between float-left w-100">
                                                <strong>Đang chuyển hàng</strong>
                                                <span class="c-total-price"><span>Flat Rate: </span>Miễn phí ship</span>
                                            </div>
                                            <div class="single-total-content tt-total d-flex justify-content-between float-left w-100">
                                                <strong>Tổng</strong>
                                                <span class="c-total-price">{{number_format($cart->total_price)}} VNĐ</span>
                                            </div>
                                            <button type="submit" class="btn btn-primary float-left w-100 text-center">Kiểm Tra Thông Tin</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>


    {{--checkout--}}
</div>
