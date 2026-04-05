@extends('layout/admin')
@section('body')
<div class="container">
    <div class="row">
        <form action="{{ route('admin.address.update',['address' => $addresses->id]) }}" method="post">
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
                <label for="name" class="form-label">Tên người nhận</label>
                <input type="text" name="name" value="{{ $addresses->name }}" class="form-control" id="name">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input name="phone" value="{{ $addresses->phone }}" id="phone" class="form-control"></input>
            </div>
            <div class="mb-3">
                <label for="address_line" class="form-label">Địa chỉ chi tiết</label>
                <input name="address_line" value="{{ $addresses->address_line }}" id="address_line" class="form-control" ></input>
            </div>
            <div class="mb-3">
                <label for="district" class="form-label">Quận/Huyện</label>
                <input name="district" value="{{ $addresses->dictrict }}" id="district" class="form-control" ></input>
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">Tỉnh/Thành phố</label>
                <input name="city" value="{{ $addresses->city }}" id="city" class="form-control" ></input>
            </div>
            <div class="mb-3">
                <label for="is_default" class="form-label">Mặc định</label>
                <select name="is_default" id="" value="{{ $addresses->is_default }}" class="form-control">
                @if ($addresses->is_default==1)
                    <option value="1" selected>Đang Mặc định</option>
                @else
                    <option value="1" >Đang Mặc định</option>
                @endif
                    <option value="0" >Ngừng Mặc định</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Address</button>
        </form>
    </div>
</div>
@endsection
