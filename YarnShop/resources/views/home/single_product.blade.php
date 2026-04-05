@extends('layout/home')
@section('body')
<!-- inner page section -->
<section class="inner_page_head">
    <div class="container_fuild">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <h3>Chi tiết sản phẩm</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end inner page section -->

<!-- single product section -->
<section class="why_section layout_padding">
    <div class="container">

        <div class="row">
            <!-- IMAGE -->
            <div class="col-lg-5">
                <div class="img-box">
                    <img src="{{ $product->image}}" alt="Len milk cotton 125g" style="width:100%;">
                </div>
            </div>

            <!-- INFO -->
            <div class="col-lg-7">
                <div class="detail-box">
                    <h2>{{ $product->name }}</h2>

                    <h4 style="color:red; margin:15px 0;">{{ number_format($product->price) }} VNĐ</h4>

                    <p>
                        {{ $product->description }}
                    </p>

                    <p><strong>Tình trạng:</strong>{{ $product->stock }} sản phẩm</p>

                    <form action="{{ route('cart.add', $product->id) }}" method="GET">
                        <label>Số lượng:</label>
                        <input 
                            type="number" 
                            name="quantity" 
                            value="1" 
                            min="1" 
                            style="width:70px;"
                        >
                        <button type="submit" class="btn1">
                            <i class="fa fa-shopping-cart"></i> Thêm vào giỏ
                        </button>
                    </form>
                    
                    <form action="{{ route('checkout') }}" method="GET" class="d-inline">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn2">
                            Mua ngay
                        </button>
                    </form>


                </div>
            </div>
        </div>

        <!-- DESCRIPTION -->
        <div class="row mt-5">
            <div class="col-md-12">
                <h3>Mô tả chi tiết</h3>
                <p>
                    {{$product->description}}
                </p>
            </div>
        </div>

        <!-- GUIDE -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h3>Hướng dẫn sử dụng & bảo quản</h3>
                    <ul>
                    @if($product->category->name == 'Len sợi')
                        <li>Giặt tay hoặc giặt máy nhẹ, nhiệt độ nước thấp.</li>
                        <li>Không sử dụng chất tẩy mạnh để tránh phai màu.</li>
                        <li>Không vắt mạnh, giữ form sợi len.</li>
                        <li>Phơi nơi khô ráo, thoáng mát, tránh ánh nắng trực tiếp.</li>
                    @else
                        <li>Vệ sinh bằng khăn ẩm hoặc rửa nhẹ với nước, tránh dùng chất tẩy mạnh.</li>
                        <li>Không để rơi hoặc va chạm mạnh để tránh cong, vênh hoặc gãy.</li>
                        <li>Bảo quản nơi khô ráo, tránh ánh nắng trực tiếp.</li>
                        <li>Giữ dụng cụ sạch sau khi sử dụng để đảm bảo độ bền.</li>
                    @endif
                    </ul>
            </div>
        </div>

        <!-- REVIEW -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h3>Đánh giá sản phẩm</h3>
                <p>⭐⭐⭐⭐⭐</p>
                <p>Hiện chưa có đánh giá cho sản phẩm này.</p>
            </div>
        </div>

    </div>
</section>
<!-- end single product section -->

<!-- arrival section -->
<section class="arrival_section">
    <div class="container">
        <div class="box">
            <div class="arrival_bg_box">
                <img src="{{ asset('images/arrival-bg.jpg') }}" alt="">
            </div>
            <div class="row">
                <div class="col-md-6 ml-auto">
                    <div class="heading_container remove_line_bt">
                        <h2>#Sản phẩm liên quan</h2>
                    </div>
                    <p style="margin-top: 20px;margin-bottom: 30px;">
                        Khám phá thêm nhiều loại len khác như len nhung,
                        len mohair, len lông thỏ với đa dạng màu sắc
                        và độ dày khác nhau.
                    </p>
                    <a href="shop.html">
                        Xem thêm sản phẩm
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end arrival section -->
@endsection