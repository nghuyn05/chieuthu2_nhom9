@extends('layout/admin')
@section('body')

<div class="card shadow mb-4">
    <div class="card-header py-3 bg-dark text-white d-flex justify-content-between align-items-center">
        <h5 class="m-0 font-weight-bold">Cart</h5>
        <a href="{{ route('admin.carts.create') }}" class="btn btn-success btn-sm">
            <i class="fa-solid fa-plus"></i> Add Cart
        </a>
    </div>

    <div class="card-body bg-light">
      <div class="table-responsive">
          <table class="table table-bordered table-hover text-center align-middle">
              <thead class="table-primary text-dark">
                    <tr>
                        <th scope="col" style="width: 5%;">STT</th>
                        <th scope="col" style="width: 20%;">Khách hàng</th>
                        <th scope="col" style="width: 15%;">Ngày tạo</th>
                        <th scope="col" style="width: 10%;">Cập nhật lần cuối</th>
                        <th scope="col" style="width: 7%;">View</th>
                        <th scope="col" style="width: 7%;">Edit</th>
                        <th scope="col" style="width: 7%;">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($carts as $object)
                    <tr>
                        <th scope="row">{{ $object->id }}</th>
                        <td>{{ $object->customer->name }}</td>
                        <td>{{ $object->created_at }}</td>
                        <td>{{ $object->updated_at }}</td>
                        <td><i class="fa-solid fa-eye text-info"></i></td>
                        <td><a href="{{ route('admin.carts.edit',['cart'=>$object->id]) }}" class="fa-solid fa-pen-to-square text-warning"></a>
                        </i></td>
                        <td><a href="{{route('admin.carts.destroy',['cart'=>$object->id])}}" title="Delete {{$object->name}}" onclick="event.preventDefault();window.confirm('Bạn đã chắc chắn xóa '+ '{{$object->name}}' +' chưa?') ?document.getElementById('carts-delete-{{ $object->id }}').submit() :0;" class="fa-solid fa-trash text-danger"></i>
                                <form action="{{ route('admin.carts.destroy', ['cart' => $object->id]) }}" method="post" id="carts-delete-{{ $object->id }}">
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
        <h5 class="m-0 font-weight-bold">Order</h5>
        <a href="{{ route('admin.order_management.create') }}" class="btn btn-success btn-sm">
            <i class="fa-solid fa-plus"></i> Add Order
        </a>
    </div>

    <div class="card-body bg-light">
        <form method="GET" class="mb-3 d-flex gap-2">
            <select name="status" class="form-control w-auto">
                <option value="">-- Tất cả trạng thái --</option>
                <option value="1" {{ request('status')=='1'?'selected':'' }}>Chờ xử lý</option>
                <option value="2" {{ request('status')=='2'?'selected':'' }}>Đang giao</option>
                <option value="3" {{ request('status')=='3'?'selected':'' }}>Hoàn thành</option>
                <option value="0" {{ request('status')=='0'?'selected':'' }}>Hủy</option>
            </select>

            <button class="btn btn-primary">Lọc</button>

            <a href="{{ route('admin.order_management.index') }}" class="btn btn-secondary">
                Reset
            </a>
        </form>
      <div class="table-responsive">
          <table class="table table-bordered table-hover text-center align-middle">
              <thead class="table-primary text-dark">
                    <tr>
                        <th scope="col" style="width: 5%;">STT</th>
                        <th scope="col" style="width: 20%;">Customer Name</th>
                        <th scope="col" style="width: 15%;">Total_price</th>
                        <th scope="col" style="width: 10%;">Status</th>
                        <th scope="col" style="width: 7%;">View</th>
                        <th scope="col" style="width: 7%;">Edit</th>
                        <th scope="col" style="width: 7%;">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <th scope="row">{{ $order->id }}</th>
                        <td>{{ $order->customer->name }}</td>
                        <td>{{ $order->total_price }}</td>
                        <td>
                            @switch($order->status)
                                @case(1)
                                    <span class="badge bg-warning text-dark">Chờ xử lý</span>
                                    @break
                                @case(2)
                                    <span class="badge bg-info">Đang giao</span>
                                    @break
                                @case(3)
                                    <span class="badge bg-success">Hoàn thành</span>
                                    @break
                                @default
                                    <span class="badge bg-secondary">Hủy</span>
                            @endswitch
                        </td>
                        <td><a href="{{ route('admin.order_management.show', parameters: ['order_management'=>$order->id]) }}"><i class="fa-solid fa-eye text-info"></i></a></td>
                        <td><a href="{{ route('admin.order_management.edit',parameters: ['order_management'=>$order->id]) }}" class="fa-solid fa-pen-to-square text-warning"></a>
                        </i></td>
                        <td><a href="{{route('admin.order_management.destroy',['order_management'=>$order->id])}}" title="Delete {{$order->name}}" onclick="event.preventDefault();window.confirm('Bạn đã chắc chắn xóa '+ '{{$order->name}}' +' chưa?') ?document.getElementById('order-delete-{{ $order->id }}').submit() :0;" class="fa-solid fa-trash text-danger"></i>
                                <form action="{{ route('admin.order_management.destroy', ['order_management' => $order->id]) }}" method="post" id="order-delete-{{ $order->id }}">
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
