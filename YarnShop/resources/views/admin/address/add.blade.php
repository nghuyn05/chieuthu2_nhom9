@extends('layout/admin')
@section('body')
<div class="container">
    <div class="row">
        <form action="{{ route('admin.address.store') }}" method="post">
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
                <label for="name" class="form-label">Tên người nhận</label>
                <input type="text" name="name" class="form-control" id="name">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Address Phone</label>
                <input type="text" name="phone" class="form-control" id="phone">
            </div>
            <div class="mb-3">
                <label for="address_line" class="form-label">Address Line</label>
                <input type="text" name="address_line" class="form-control" id="address_line">
            </div>
            <div class="mb-3">
                <label for="district" class="form-label">Address District</label>
                <input type="text" name="district" class="form-control" id="dictrict">
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">Address City</label>
                <input type="text" name="city" class="form-control" id="city">
            </div>
            <div class="mb-3">
                <label for="is_default" class="form-label">Mặc định</label>
                <select name="is_default" id="is_default" class="form-control" required>
                    <option value="1">Đang Mặc định</option>
                    <option value="0">Không mặc định</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Thêm address</button>
            <a href="{{ route('admin.address.index') }}" class="btn btn-secondary" >
               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-skip-backward-fill" viewBox="0 0 16 16">
  <path d="M.5 3.5A.5.5 0 0 0 0 4v8a.5.5 0 0 0 1 0V8.753l6.267 3.636c.54.313 1.233-.066 1.233-.697v-2.94l6.267 3.636c.54.314 1.233-.065 1.233-.696V4.308c0-.63-.693-1.01-1.233-.696L8.5 7.248v-2.94c0-.63-.692-1.01-1.233-.696L1 7.248V4a.5.5 0 0 0-.5-.5"/>
</svg></a>
        </form>
    </div>
</div>
@endsection
