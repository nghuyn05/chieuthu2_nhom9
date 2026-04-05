@extends('layout/admin')
@section('body')
<div class="container">
    <div class="row">
        <form action="{{ route('admin.customer_management.update',['customer_management'=>$customer->id]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Customer Name</label>
                <input type="text" name="name" value="{{ $customer->name }}" class="form-control" id="name" >
            </div>
            <div class="mb-3">
                <label for="email" class="form-label"> Email</label>
                <input type="text" name="email" value="{{ $customer->email }}" class="form-control" id="email" >
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Customer Phone</label>
                <input type="text" name="phone" class="form-control" id="phone" >
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Customer Password</label>
                <input type="text" name="password" value="{{ $customer->password }}" class="form-control" id="password" >
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Customer Status</label>
                <select name="status" id="" value="{{ $customer->status }}" class="form-control">
                @if ($customer->status==1)
                    <option value="1" selected>On</option>
                @else
                    <option value="1" >On</option>
                @endif
                    <option value="0" >Off</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection