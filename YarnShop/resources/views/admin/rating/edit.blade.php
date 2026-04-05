@extends('layout/admin')
@section('body')
<div class="container">
    <div class="row">
        <form action="{{ route('admin.rating.update',['rating' => $rating->id]) }}" method="post">
            @csrf
            @method('PUT')
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
                        <option value="{{ $product->id }}">
                            {{ $product->name }} (ID: {{ $product->id }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <select name="status" id="" value="{{ $rating->status }}" class="form-control">
                @if ($product->status==1)
                    <option value="1" selected>Đang đánh giá</option>
                @else
                    <option value="1" >Đang đánh giá</option>
                @endif
                    <option value="0" >Ngừng đánh giá</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="score" class="form-label">Điểm đánh giá</label>
                <input type="number" name="score" value="{{ $rating->score }}" class="form-control" min="1" max="5">
            </div>

            <div class="mb-3">
                <label for="comment" class="form-label">Nội dung bình luận</label>
                <textarea name="comment" class="form-control" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update bình luận</button>
        </form>
    </div>
</div>
@endsection
