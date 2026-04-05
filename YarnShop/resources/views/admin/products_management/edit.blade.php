@extends('layout/admin')
@section('body')
<div class="container">
    <div class="row">
        <form action="{{ route('admin.products_management.update', ['products_management' => $product->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->id }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" name="name" value="{{ $product->name }}" class="form-control" id="name" aria-describedby="emailHelp">
            </div>
             <div class="mb-3">
                <label for="price" class="form-label">Product Price</label>
                <input type="text" name="price" value="{{ $product->price }}" class="form-control" id="price" aria-describedby="emailHelp">
            </div>
             <div class="mb-3">
                <label for="stock" class="form-label">Product Stock</label>
                <input type="text" name="stock" value="{{ $product->stock }}" class="form-control" id="stock" aria-describedby="emailHelp">
            </div>
             <div class="mb-3">
                <label for="image" class="form-label">Product Image</label>
                <input type="text" name="image" class="form-control" id="image" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Product Status</label>
                <select name="status" id="" value="{{ $product->status }}" class="form-control">
                @if ($product->status==1)
                    <option value="1" selected>Đang bán</option>
                @else
                    <option value="1" >Đang bán</option>
                @endif
                    <option value="0" >Ngừng bán</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Product Description</label>
                <input type="text" name="description" value="{{ $product->description }}" class="form-control" id="description" aria-describedby="emailHelp">
            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
</div>
@endsection