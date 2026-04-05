@extends('layout/admin')
@section('body')
<div class="container">
    <div class="row">
        <form action="{{ route('admin.order_management.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">Customer</label>
                <select name="customer_id" class="form-control" required>
                    <option value="">-- Select Customer --</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="total_price" class="form-label">Total Price</label>
                <input type="number" name="total_price" class="form-control" id="total_price" >
            </div>
            <div class="mb-3">
                <label class="form-label">Trạng thái đơn hàng</label>
                <select name="status" class="form-control">
                    <option value="1">Chờ xử lý</option>
                    <option value="2">Đang giao</option>
                    <option value="3">Hoàn thành</option>
                    <option value="0">Hủy</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add order</button>
            <a href="{{ route('admin.order_management.index') }}" class="btn btn-secondary" >
               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-skip-backward-fill" viewBox="0 0 16 16">
  <path d="M.5 3.5A.5.5 0 0 0 0 4v8a.5.5 0 0 0 1 0V8.753l6.267 3.636c.54.313 1.233-.066 1.233-.697v-2.94l6.267 3.636c.54.314 1.233-.065 1.233-.696V4.308c0-.63-.693-1.01-1.233-.696L8.5 7.248v-2.94c0-.63-.692-1.01-1.233-.696L1 7.248V4a.5.5 0 0 0-.5-.5"/>
</svg></a>
        </form>
    </div>
</div>
@endsection