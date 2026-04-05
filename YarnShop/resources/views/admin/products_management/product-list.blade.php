@extends('layout/admin')
@section('body')
<div class="card shadow mb-4">
  <div class="card-header py-3 bg-dark text-white d-flex justify-content-between align-items-center">
      <h5 class="m-0 font-weight-bold">Danh mục sản phẩm</h5>
      <a href="{{ route('admin.products_management.create') }}" class="btn btn-primary btn-sm">
          <i class="fa-solid fa-plus"></i> Add
      </a>
  </div>

  <div class="card-body bg-light">
    <form action="{{ route('admin.products_management.index') }}" method="GET" class="mb-3 d-flex gap-2">
        <input type="text"
              name="search"
              class="form-control"
              style="max-width: 1000px"
              placeholder="Tìm theo tên sản phẩm..."
              value="{{ request('search') }}">

        <select name="status" class="form-select" style="max-width: 180px">
            <option value="">-- Tất cả trạng thái --</option>
            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>
                Hiển thị
            </option>
            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>
                Ẩn
            </option>
        </select>

        <button type="submit" class="btn btn-primary">
            <i class="fa fa-search"></i>
        </button>
        <a href="{{ route('admin.products_management.index') }}" class="btn btn-secondary">
            Reset
        </a>
    </form>
    <div class="table-responsive">
          <table class="table table-bordered table-hover text-center align-middle"> 
              <thead class="table-primary text-dark">
                 <tr>
                      <th scope="col">STT</th>
                      <th scope="col">Danh mục</th>
                      <th scope="col">Tên Sản Phẩm</th>
                      <th scope="col">Giá</th>
                      <th scope="col">Số Lượng</th>
                      <th scope="col">Hình</th>
                      <th scope="col">Trạng thái</th>
                      <th scope="col">Mô tả</th>
                      <th scope="col">View</th>
                      <th scope="col">Edit</th>
                      <th scope="col">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                     @forelse($products as $object)
                    <tr>
                      <th scope="row">{{ $object->id }}</th>
                      <td>{{ $object->category->name }}</td>
                      <td>{{ $object->name }}</td>
                      <td>{{ $object->price }}</td>
                      <td>{{ $object->stock }}</td>
                      <td><img src="{{ $object->image }}" alt="" width="50"></td>
                      <td>
                      @if ($object->status == 1)
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle text-success" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
</svg>
                      @else
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle text-secondary" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
</svg>
                        @endif
                    </td>
                      <td>{{ $object->description }}</td>
                      <td><a href="{{ route('admin.products_management.show', $object->id) }}"><i class="fa-solid fa-eye text-info"></i></a></td>
                      <td><a href="{{ route('admin.products_management.edit',['products_management'=>$object->id]) }}" class="fa-solid fa-pen-to-square text-warning"></a>
                      </td>
                      <td><a href="{{route('admin.products_management.destroy',['products_management'=>$object->id])}}" title="Delete {{$object->name}}" onclick="event.preventDefault();window.confirm('Bạn đã chắc chắn xóa '+ '{{$object->name}}' +' chưa?') ?document.getElementById('products_management-delete-{{ $object->id }}').submit() :0;" class="fa-solid fa-trash text-danger"></i>
                              <form action="{{ route('admin.products_management.destroy', ['products_management' => $object->id]) }}" method="post" id="products_management-delete-{{ $object->id }}">
                                  {{ csrf_field() }}
                                  {{ method_field('delete') }}
                              </form>
                          </a>
                      </td>                   
                    </tr>
                    @empty
                        <h1>chua du lieu</h1>
                    @endforelse
              </tbody>
          </table>
      </div>
  </div>
</div>


<div class="card shadow mb-4">
  <div class="card-header py-3 bg-dark text-white d-flex justify-content-between align-items-center">
      <h5 class="m-0 font-weight-bold">Comment</h5>
      <a href="{{ route('admin.comment.create') }}" class="btn btn-primary btn-sm">
          <i class="fa-solid fa-plus"></i> Add
      </a>
  </div>

  <div class="card-body bg-light">
      <div class="table-responsive">
          <table class="table table-bordered table-hover text-center align-middle">
              <thead class="table-primary text-dark">
                 <tr>
                      <th scope="col">STT</th>
                      <th scope="col">Tên Khách Hàng</th>
                      <th scope="col">Sản Phẩm</th>
                      <th scope="col">Nội Dung Bình Luận</th>
                      <th scope="col">Trạng thái</th>
                      <th scope="col">View</th>
                      <th scope="col">Edit</th>
                      <th scope="col">Delete</th>
                    </tr>
                  </thead>
              <tbody>
                     @forelse($comments as $object)
                    <tr>
                      <th scope="row">{{ $object->id }}</th>
                      <td>{{ $object->customer->name }}</td>
                      <td>{{ $object->product->name }}</td>
                      <td>{{ $object->content }}</td>
                      <td>
                      @if ($object->status == 1)
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle text-success" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
</svg>
                      @else
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle text-secondary" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
</svg>
                        @endif
                    </td>
                      <td><i class="fa-solid fa-eye text-info"></i></td>
                      <td><a href="{{ route('admin.comment.edit',['comment'=>$object->id]) }}" class="fa-solid fa-pen-to-square text-warning"></a>
                        </i></td>
                      <td><a href="{{route('admin.comment.destroy',['comment'=>$object->id])}}" title="Delete {{$object->name}}" onclick="event.preventDefault();window.confirm('Bạn đã chắc chắn xóa '+ '{{$object->name}}' +' chưa?') ?document.getElementById('comment-delete-{{ $object->id }}').submit() :0;" class="fa-solid fa-trash text-danger"></i>
                              <form action="{{ route('admin.comment.destroy', ['comment' => $object->id]) }}" method="post" id="comment-delete-{{ $object->id }}">
                                  {{ csrf_field() }}
                                  {{ method_field('delete') }}
                              </form>
                          </a>
                      </td>           
                    </tr>
                    @empty
                        <h1>chua du lieu</h1>
                    @endforelse
              </tbody>
          </table>
      </div>
  </div>
</div>

<div class="card shadow mb-4">
  <div class="card-header py-3 bg-dark text-white d-flex justify-content-between align-items-center">
      <h5 class="m-0 font-weight-bold">Đánh giá</h5>
      <a href="{{ route('admin.rating.create') }}" class="btn btn-primary btn-sm">
          <i class="fa-solid fa-plus"></i> Add
      </a>
  </div>

  <div class="card-body bg-light">
      <div class="table-responsive">
          <table class="table table-bordered table-hover text-center align-middle">
              <thead class="table-primary text-dark">
                 <tr>
                      <th scope="col">STT</th>
                      <th scope="col">Tên Khách hàng</th>
                      <th scope="col">Tên Sản phẩm</th>
                      <th scope="col">Điểm đánh giá(Score)</th>
                      <th scope="col">Nội dung (Comment)</th>
                      <th scope="col">Trạng thái</th>
                      <th scope="col">View</th>
                      <th scope="col">Edit</th>
                      <th scope="col">Delete</th>
                    </tr>
                  </thead>
              <tbody>
                     @forelse($ratings as $object)
                    <tr>
                      <th scope="row">{{ $object->id }}</th>
                      <td>{{ $object->customer->name }}</td>
                      <td>{{ $object->product->name }}</td>
                      <td>{{ $object->score }}</td>
                      <td>{{ $object->comment }}</td>
                      <td>
                      @if ($object->status == 1)
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle text-success" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
</svg>
                      @else
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle text-secondary" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
</svg>
                        @endif
                    </td>
                      <td><i class="fa-solid fa-eye text-info"></i></td>
                      <td><a href="{{ route('admin.rating.edit',['rating'=>$object->id]) }}" class="fa-solid fa-pen-to-square text-warning"></a>
                        </i></td>
                      <td><a href="{{route('admin.rating.destroy',['rating'=>$object->id])}}" title="Delete {{$object->name}}" onclick="event.preventDefault();window.confirm('Bạn đã chắc chắn xóa '+ '{{$object->name}}' +' chưa?') ?document.getElementById('rating-delete-{{ $object->id }}').submit() :0;" class="fa-solid fa-trash text-danger"></i>
                              <form action="{{ route('admin.rating.destroy', ['rating' => $object->id]) }}" method="post" id="rating-delete-{{ $object->id }}">
                                  {{ csrf_field() }}
                                  {{ method_field('delete') }}
                              </form>
                          </a>
                      </td>                
                    </tr>
                    @empty
                        <h1>chua du lieu</h1>
                    @endforelse
              </tbody>
          </table>
      </div>
  </div>
</div>
@endsection