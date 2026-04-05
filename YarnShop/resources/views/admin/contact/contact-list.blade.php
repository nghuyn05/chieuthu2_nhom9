@extends('layout/admin')
@section('body')

<div class="card shadow mb-4">
  <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
      <h5 class="m-0 font-weight-bold">Contact từ khách hàng</h5>
  </div>

  @if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="card-body bg-light">
    <div class="table-responsive"></div>
        <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Tiêu đề</th>
                    <th>Nội dung</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->email }}</td>
                    <td>{{ $c->subject }}</td>
                    <td>{{ Str::limit($c->message, 50) }}</td>
                    <td>
                        @if($c->status == 0)
                            <span class="badge bg-danger">Chưa đọc</span>
                        @else
                            <span class="badge bg-success">Đã đọc</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.contact.show', $c->id) }}"
                        class="btn btn-sm btn-primary">Xem</a>

                        <form action="{{ route('admin.contact.destroy', $c->id) }}"
                            method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
