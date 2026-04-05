@extends('layout/admin')
@section('body')
<div class="container">
    <div class="row">
        <form action="{{ route('admin.comment.update',['comment' => $comment->id]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="customer_id" class="form-label">Khách hàng</label>
                <select name="customer_id" id="customer_id" class="form-control" required>
                    <option value="">-- Chọn khách hàng --</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }} (ID: {{ $customer->id }})</option>
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
                <label for="status" class="form-label">Comment Status</label>
                <select name="status" id="" value="{{ $comment->status }}" class="form-control">
                @if ($product->status==1)
                    <option value="1" selected>Đang comment</option>
                @else
                    <option value="1" >Đang comment</option>
                @endif
                    <option value="0" >Ngừng comment</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Nội dung bình luận</label>
                <textarea name="content" id="content" class="form-control" rows="3" ></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update bình luận</button>
        </form>
    </div>
</div>
@endsection
