@extends('layout/admin')
@section('body')
<div class="container">
    <div class="row">
        <form action="{{ route('admin.customer_management.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Customer Name</label>
                <input type="text" name="name" class="form-control" id="name" >
            </div>
            <div class="mb-3">
                <label for="email" class="form-label"> Email</label>
                <input type="text" name="email" class="form-control" id="email" >
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Customer Phone</label>
                <input type="text" name="phone" class="form-control" id="phone" >
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Customer Password</label>
                <input type="text" name="password" class="form-control" id="password" >
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Customer Status</label>
                <select name="status" id="" class="form-control">
                    <option value="1">On</option>
                    <option value="0">Off</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add customer</button>
            <a href="{{ route('admin.customer_management.index') }}" class="btn btn-secondary" >
               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-skip-backward-fill" viewBox="0 0 16 16">
  <path d="M.5 3.5A.5.5 0 0 0 0 4v8a.5.5 0 0 0 1 0V8.753l6.267 3.636c.54.313 1.233-.066 1.233-.697v-2.94l6.267 3.636c.54.314 1.233-.065 1.233-.696V4.308c0-.63-.693-1.01-1.233-.696L8.5 7.248v-2.94c0-.63-.692-1.01-1.233-.696L1 7.248V4a.5.5 0 0 0-.5-.5"/>
</svg></a>
        </form>
    </div>
</div>
@endsection