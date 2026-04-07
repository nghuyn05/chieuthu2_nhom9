@extends('layout.home')

@section('body')
<div class="container py-5">
    <h3>Đăng ký</h3>

    @if($errors->any())
        @foreach($errors->all() as $err)
            <p class="text-danger">{{ $err }}</p>
        @endforeach
    @endif

    <form method="POST" action="{{ route('user.register') }}">
        @csrf
        <input type="text" name="name" placeholder="Họ tên" class="form-control mb-3" required>
        <input type="email" name="email" placeholder="Email" class="form-control mb-3" required>
        <input type="password" name="password" placeholder="Mật khẩu" class="form-control mb-3" required>

        <button class="btn btn-success">Đăng ký</button>
    </form>
</div>
@endsection
