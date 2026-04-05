@extends('layout.home')
@section('body')
<!-- inner page section -->
<section class="inner_page_head">
    <div class="container_fuild">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <h3>Thanh toán</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end inner page section -->
<section class="checkout_section py-5">
    <div class="container">
        @if(session('success'))
            <p class="text-success">{{ session('success') }}</p>
        @endif
        @if(session('error'))
            <p class="text-danger">{{ session('error') }}</p>
        @endif

        @if($cart && count($cart) > 0)
            <p>Bạn có {{ count($cart) }} mặt hàng trong giỏ hàng.</p>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $item)
                        @php $subtotal = $item['price'] * $item['quantity']; @endphp
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ number_format($item['price'],0,',','.') }}₫</td>
                            <td>{{ number_format($subtotal,0,',','.') }}₫</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="text-right"><strong>Tổng cộng:</strong></td>
                        <td><strong>{{ number_format($total,0,',','.') }}₫</strong></td>
                    </tr>
                </tbody>
            </table>

            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Thanh toán</button>
            </form>
        @else
            <p>Giỏ hàng của bạn đang trống. <a href="{{ route('product') }}">Mua sắm ngay</a></p>
        @endif
    </div>
</section>
@endsection
