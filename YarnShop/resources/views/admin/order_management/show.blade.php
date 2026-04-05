@extends('layout/admin')

@section('body')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-dark text-white d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold">Chi tiết đơn hàng</h5>
            <a href="{{ route('admin.order_management.index') }}" class="btn btn-secondary btn-sm">
                <i class="fa-solid fa-arrow-left"></i> Quay lại
            </a>
        </div>

        <div class="card-body bg-light">
            <p>
                <strong>Mã đơn hàng:</strong>
                {{ $order->id }}
            </p>

            <p>
                <strong>Khách hàng:</strong>
                {{ optional($order->customer)->name ?? 'Chưa có khách hàng' }}
            </p>

            <p>
                <strong>Tổng tiền:</strong>
                {{ number_format($order->total_price) }} VNĐ
            </p>

            <p>
                <strong>Trạng thái:</strong>
                @if($order->status == 1)
                    <span class="badge bg-success">Hoạt động</span>
                @else
                    <span class="badge bg-secondary">Ngưng hoạt động</span>
                @endif
            </p>

            <p>
    <strong>Ngày tạo:</strong>
    {{ $order->created_at ? $order->created_at->format('d/m/Y H:i') : 'Không có dữ liệu' }}
</p>

<p>
    <strong>Cập nhật lần cuối:</strong>
    {{ $order->updated_at ? $order->updated_at->format('d/m/Y H:i') : 'Không có dữ liệu' }}
</p>

        </div>
    </div>
</div>
@endsection
