@extends('layout.home')

@section('body')

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

<style>
    .cart_section {
        background: #f8f9fa;
    }

    .cart_table img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    .cart_table input {
        width: 70px;
        text-align: center;
    }

    .cart-actions {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
    }
</style>

<section class="cart_section py-5">
    <div class="container">

        @if($cartItems && count($cartItems) > 0)

            <div class="table-responsive">
                <table class="table table-bordered text-center cart_table">
                    <thead class="thead-dark">
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

                        @foreach($cartItems as $item)

                            @php
                                $subtotal = $item->price * $item->quantity;
                                $total += $subtotal;
                            @endphp

                            <tr>
                                <td>
                                    <img src="{{ asset($item->image) }}" width="60">
                                </td>

                                <td>{{ $item->product_name }}</td>

                                <td>{{ number_format($item->price) }} VNĐ</td>

                                <td>
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <input type="number" name="quantity"
                                               value="{{ $item->quantity }}" min="1">

                                        <button class="btn btn-primary btn-sm mt-1">Update</button>
                                    </form>
                                </td>

                                <td>{{ number_format($subtotal) }} VNĐ</td>

                                <td>
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Remove</button>
                                    </form>
                                </td>
                            </tr>

                        @endforeach

                        <tr>
                            <td colspan="4"><strong>Total</strong></td>
                            <td colspan="2"><strong>{{ number_format($total) }} VNĐ</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- FIX BUTTONS (BẠN BỊ MẤT CÁI NÀY) --}}
            <div class="cart-actions">
                <a href="{{ route('product') }}" class="btn btn-secondary">
                    Continue Shopping
                </a>

                <a href="{{ route('checkout') }}" class="btn btn-success">
                    Proceed to Checkout
                </a>
            </div>

        @else
            <p class="text-center">Cart is empty</p>
        @endif

    </div>
</section>

@endsection