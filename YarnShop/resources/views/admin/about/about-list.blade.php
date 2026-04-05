@extends('layout/admin')
@section('body')

<div class="card shadow mb-4">
  <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
      <h5 class="m-0 font-weight-bold">About</h5>
      <a href="{{ route('admin.about.create') }}" class="btn btn-primary btn-sm">
          <i class="fa-solid fa-plus"></i> Add
      </a>
  </div>

  <div class="card-body bg-light">
    <div class="table-responsive">
      <table class="table table-bordered table-hover text-center align-middle">
        <thead class="table-primary">
          <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content 1</th>
            <th>Content 2</th>
            <th>Content 3</th>
            <th>Image</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          @forelse($abouts as $object)
          <tr>
            <td>{{ $object->id }}</td>
            <td>{{ $object->title }}</td>
            <td>{{ Str::limit($object->content_1, 40) }}</td>
            <td>{{ Str::limit($object->content_2, 40) }}</td>
            <td>{{ Str::limit($object->content_3, 40) }}</td>
            <td><img src="{{ $object->image }}" width="50"></td>
            <td>
              @if($object->status==1)
                <i class="fa-solid fa-circle-check text-success"></i>
              @else
                <i class="fa-solid fa-circle-check text-secondary"></i>
              @endif
            </td>
            <td>
              <a href="{{ route('admin.about.edit',['about'=>$object->id]) }}"
                 class="fa-solid fa-pen-to-square text-warning"></a>
            </td>
            <td>
              <a href="{{ route('admin.about.destroy',['about'=>$object->id]) }}"
                 onclick="event.preventDefault();
                 if(confirm('Xóa about này?'))
                 document.getElementById('about-delete-{{$object->id}}').submit();"
                 class="fa-solid fa-trash text-danger"></a>

              <form method="POST"
                    action="{{ route('admin.about.destroy',['about'=>$object->id]) }}"
                    id="about-delete-{{$object->id}}">
                @csrf
                @method('DELETE')
              </form>
            </td>
          </tr>
          @empty
          <tr><td colspan="7">Chưa có dữ liệu</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
