@extends('layout/admin')
@section('body')
<div class="container">
<form method="POST" action="{{ route('admin.about.store') }}">
@csrf

<div class="mb-3">
    <label>Title</label>
    <input type="text" name="title" class="form-control">
</div>

<div class="mb-3">
    <label>Content 1</label>
    <input type="text" name="content_1" class="form-control">
</div>

<div class="mb-3">
    <label>Content 2</label>
    <input type="text" name="content_2" class="form-control">
</div>

<div class="mb-3">
    <label>Content 3</label>
    <input type="text" name="content_3" class="form-control">
</div>

<div class="mb-3">
    <label>Image</label>
    <input type="text" name="image" class="form-control">
</div>

<div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control">
        <option value="1">Hiển thị</option>
        <option value="0">Ẩn</option>
    </select>
</div>

<button class="btn btn-primary">Add</button>
<a href="{{ route('admin.about.index') }}" class="btn btn-secondary">Back</a>
</form>
</div>
@endsection
