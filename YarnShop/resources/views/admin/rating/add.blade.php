@extends('layout/admin')
@section('body')
<div class="container">
    <div class="row">
        <form action="{{ route('admin.rating.store') }}" method="post">
            @csrf

            <div class="mb-3">
                <label for="customer_id" class="form-label">Khách hàng</label>
                <select name="customer_id" id="customer_id" class="form-control" required>
                    <option value="">-- Chọn khách hàng --</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">
                        {{ $customer->name }} (ID: {{ $customer->id }})
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="product_id" class="form-label">Sản phẩm</label>
                <select name="product_id" id="product_id" class="form-control" required>
                    <option value="">-- Chọn sản phẩm --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} (ID: {{ $product->id }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="1">Đang đánh giá</option>
                    <option value="0">Ngừng đánh giá</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="score" class="form-label">Điểm đánh giá</label>
                <input type="number" name="score" class="form-control" min="1" max="5">
            </div>

            <div class="mb-3">
                <label for="comment" class="form-label">Nội dung bình luận</label>
                <textarea name="comment" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Thêm bình luận</button>
            <a href="{{ route('admin.rating.index') }}" class="btn btn-secondary" >
               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-skip-backward-fill" viewBox="0 0 16 16">
  <path d="M.5 3.5A.5.5 0 0 0 0 4v8a.5.5 0 0 0 1 0V8.753l6.267 3.636c.54.313 1.233-.066 1.233-.697v-2.94l6.267 3.636c.54.314 1.233-.065 1.233-.696V4.308c0-.63-.693-1.01-1.233-.696L8.5 7.248v-2.94c0-.63-.692-1.01-1.233-.696L1 7.248V4a.5.5 0 0 0-.5-.5"/>
</svg></a>
        </form>
    </div>
</div>
@endsection
