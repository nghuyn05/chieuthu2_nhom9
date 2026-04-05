@extends('layout/admin')
@section('body')
<div class="container">
    <div class="row">
        <form action="{{ route('admin.category.update',['category'=>$category->id]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" name="name" value="{{ $category->name }}" class="form-control" id="name" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label"> Image</label>
                <input type="text" name="image" value="{{ $category->image }}" class="form-control" id="image" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Category Description</label>
                <input type="text" name="description" value="{{ $category->description }}" class="form-control" id="description" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Category Status</label>
                <select name="status" id="" value="{{ $category->status }}" class="form-control">
                @if ($category->status==1)
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