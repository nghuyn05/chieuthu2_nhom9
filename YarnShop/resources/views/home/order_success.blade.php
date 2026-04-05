@extends('layout.home')

@section('body')
<section class="container py-5">
    <h2 class="text-success">Thanh toán thành công</h2>

    <p><strong>Mã đơn hàng:</strong> #{{ $order->id }}</p>
    <p><strong>Trạng thái:</strong> {{ $order->status }}</p>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'Sản phẩm' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price) }}₫</td>
                    <td>{{ number_format($item->price * $item->quantity) }}₫</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4 class="text-right">
        Tổng tiền: {{ number_format($order->total_price) }}₫
    </h4>

    <a href="{{ route('home') }}" class="btn btn-primary mt-3">
        Tiếp tục mua sắm
    </a>
</section>
@endsection
