@extends('layout/admin')
@section('body')

<div class="card shadow mb-4">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
        <h5 class="m-0 font-weight-bold">Customer</h5>
        <a href="{{ route('admin.customer_management.create') }}" class="btn btn-success btn-sm">
            <i class="fa-solid fa-plus"></i> Add Customer
        </a>
    </div>

    <div class="card-body bg-light">
      <div class="table-responsive">
          <table class="table table-bordered table-hover text-center align-middle">
              <thead class="table-primary text-dark">
                    <tr>
                        <th scope="col" style="width: 5%;">STT</th>
                        <th scope="col" style="width: 20%;">Full Name</th>
                        <th scope="col" style="width: 20%;">Email</th>
                        <th scope="col" style="width: 15%;">Phone</th>
                        <th scope="col" style="width: 15%;">Password</th>
                        <th scope="col" style="width: 15%;">Trạng thái</th>
                        <th scope="col" style="width: 8%;">View</th>
                        <th scope="col" style="width: 8%;">Edit</th>
                        <th scope="col" style="width: 8%;">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $object)
                    <tr>
                        <th scope="row">{{ $object->id }}</th>
                        <td>{{ $object->name }}</td>
                        <td>{{ $object->email }}</td>
                        <td>{{ $object->phone }}</td>
                        <td>{{ $object->password }}</td>
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
                        <td><a href="{{ route('admin.customer_management.edit',['customer_management'=>$object->id]) }}" class="fa-solid fa-pen-to-square text-warning"></a>
                        </td>
                        <td><a href="{{route('admin.customer_management.destroy',['customer_management'=>$object->id])}}" title="Delete {{$object->name}}" onclick="event.preventDefault();window.confirm('Bạn đã chắc chắn xóa '+ '{{$object->name}}' +' chưa?') ?document.getElementById('customer_management-delete-{{ $object->id }}').submit() :0;" class="fa-solid fa-trash text-danger"></i>
                              <form action="{{ route('admin.customer_management.destroy', ['customer_management' => $object->id]) }}" method="post" id="customer_management-delete-{{ $object->id }}">
                                  {{ csrf_field() }}
                                  {{ method_field('delete') }}
                              </form>
                          </a></td>
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
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
        <h5 class="m-0 font-weight-bold">Address</h5>
        <a href="{{ route('admin.address.create') }}" class="btn btn-success btn-sm">
            <i class="fa-solid fa-plus"></i> Add Address
        </a>
    </div>

    <div class="card-body bg-light">
      <div class="table-responsive">
          <table class="table table-bordered table-hover text-center align-middle">
              <thead class="table-primary text-dark">
                    <tr>
                        <th scope="col" style="width: 5%;">STT</th>
                        <th scope="col" style="width: 20%;">ID Khách hàng</th>
                        <th scope="col" style="width: 20%;">Tên Người nhận</th>
                        <th scope="col" style="width: 15%;">Phone</th>
                        <th scope="col" style="width: 25%;">Địa chỉ chi tiết</th>
                        <th scope="col" style="width: 10%;">Quận/Huyện</th>
                        <th scope="col" style="width: 10%;">Tỉnh/Thành phố</th>
                        <th scope="col" style="width: 5%;">Mặc định</th>
                        <th scope="col" style="width: 8%;">View</th>
                        <th scope="col" style="width: 8%;">Edit</th>
                        <th scope="col" style="width: 8%;">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($addresses as $object)
                    <tr>
                        <th scope="row">{{ $object->id }}</th>
                        <td>{{ $object->customer->name }}</td>
                        <td>{{ $object->name }}</td>
                        <td>{{ $object->phone }}</td>
                        <td>{{ $object->address_line }}</td>
                        <td>{{ $object->district }}</td>
                        <td>{{ $object->city }}</td>
                        <td>{{ $object->is_default }}</td>
                        <td><i class="fa-solid fa-eye text-info"></i></td>
                        <td><a href="{{ route('admin.address.edit',['address'=>$object->id]) }}" class="fa-solid fa-pen-to-square text-warning"></a>
                        </i></td>
                        <td><a href="{{route('admin.address.destroy',['address'=>$object->id])}}" title="Delete {{$object->name}}" onclick="event.preventDefault();window.confirm('Bạn đã chắc chắn xóa '+ '{{$object->name}}' +' chưa?') ?document.getElementById('address-delete-{{ $object->id }}').submit() :0;" class="fa-solid fa-trash text-danger"></i>
                                <form action="{{ route('admin.address.destroy', ['address' => $object->id]) }}" method="post" id="address-delete-{{ $object->id }}">
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
