@extends('layout/home')
@section('body')
<!-- inner page section -->
<section class="inner_page_head">
    <div class="container_fuild">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <h3>Danh sách sản phẩm</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end inner page section -->

<!-- product section -->
<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Sản phẩm <span>nổi bật</span>
            </h2>

            {{-- ✅ THÊM: hiển thị keyword --}}
            @if(isset($keyword))
                <p style="margin-top:10px;">
                    Kết quả tìm kiếm cho: <strong>"{{ $keyword }}"</strong>
                </p>
            @endif

        </div>

        <div class="row">

            {{-- ✅ THÊM: nếu không có sản phẩm --}}
            @if($products->count() == 0)
                <div style="width:100%; text-align:center; color:red; font-weight:bold; padding:20px;">
                    Không tìm thấy sản phẩm nào
                </div>
            @endif

            @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ $product->image }}" class="card-img-top img-fluid" style="height: 220px; object-fit: cover;" alt="{{ $product->name }}">

                    <div class="card-body d-flex flex-column">

                        <h5 class="card-title text-center fw-bold">{{ $product->name }}</h5>

                        <p class="card-text text-muted small text-center">
                            {{ Str::limit($product->description, 80) }}
                        </p>

                        <p class="text-center mb-3">
                            <span class="badge border border-success text-success px-3 py-2">
                                Còn {{ $product->stock }} sản phẩm
                            </span>
                            <span class="badge border border-success text-success px-3 py-2">
                                {{ number_format($product->price) }} VNĐ
                            </span>
                        </p>

                        <div class="mt-auto text-center">
                            <a href="{{ route('single_product',['category'=>$product->id]) }}" class="btn btn-secondary px-3">
                                Chi tiết sản phẩm
                            </a>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

<!-- end product section -->
@endsection