@extends('layout.home')
@section('body')
<!-- inner page section -->
<section class="inner_page_head">
    <div class="container_fuild">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <h3>Your Shopping Cart</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end inner page section -->
<!-- Cart Section -->
<section class="cart_section py-5">
    <div class="container">
        @if(session('cart') && count(session('cart')) > 0)
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead class="thead-light">
                        <tr>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach(session('cart') as $id => $product)
                            @php $subtotal = $product['price'] * $product['quantity']; @endphp
                            @php $total += $subtotal; @endphp
                            <tr>
                                <td>
                                    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" width="80">
                                </td>
                                <td>{{ $product['name'] }}</td>
                                <td>{{ number_format($product['price']) }} VNĐ</td>
                                <td>
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="quantity" value="{{ $product['quantity'] }}" min="1" class="form-control d-inline" style="width:70px;">
                                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                    </form>
                                </td>
                                <td>{{ number_format($subtotal) }} VNĐ</td>
                                <td>
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-right"><strong>Total:</strong></td>
                            <td colspan="2"><strong>{{ number_format($total) }} VNĐ</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('product') }}" class="btn btn-secondary">Continue Shopping</a>
                <a href="{{ route('checkout') }}" class="btn btn-success">Proceed to Checkout</a>
            </div>
        @else
            <p class="text-center">Your cart is empty. <a href="{{ route('product') }}">Shop Now</a></p>
        @endif
    </div>
</section>
@endsection
