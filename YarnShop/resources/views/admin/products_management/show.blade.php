@extends('layout.admin')
@section('body')
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold">
                <i class="fa-solid fa-box"></i> Chi tiết sản phẩm
            </h5>
            <a href="{{ route('admin.products_management.index') }}" class="btn btn-secondary btn-sm">
                <i class="fa-solid fa-arrow-left"></i> Quay lại
            </a>
        </div>

        <div class="card-body bg-light">
            <div class="row">
                <!-- Hình ảnh -->
                <div class="col-md-4 text-center">
                    <img src="{{ $product->image }}"
                         class="img-fluid rounded shadow"
                         style="max-height: 250px;">
                </div>

                <!-- Thông tin -->
                <div class="col-md-8">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">Tên sản phẩm:</th>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <th>Danh mục:</th>
                            <td>{{ $product->category->name }}</td>
                        </tr>
                        <tr>
                            <th>Giá:</th>
                            <td class="text-danger fw-bold">
                                {{ number_format($product->price) }} VNĐ
                            </td>
                        </tr>
                        <tr>
                            <th>Số lượng tồn:</th>
                            <td>{{ $product->stock }}</td>
                        </tr>
                        <tr>
                            <th>Trạng thái:</th>
                            <td>
                                @if($product->status == 1)
                                    <span class="badge bg-success">Hiển thị</span>
                                @else
                                    <span class="badge bg-secondary">Ẩn</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Mô tả:</th>
                            <td>{{ $product->description }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
