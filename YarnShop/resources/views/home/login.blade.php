@extends('layout.home')

@section('body')
<div class="container py-5">
    <h3>Đăng nhập</h3>

    @if(session('error'))
        <p class="text-danger">{{ session('error') }}</p>
    @endif
    @if(session('success'))
        <p class="text-success">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('user.login') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" class="form-control mb-3" required>
        <input type="password" name="password" placeholder="Mật khẩu" class="form-control mb-3" required>

        <button class="btn btn-primary">Đăng nhập</button>
        <a href="{{ route('user.register.form') }}">Đăng ký</a>
    </form>
</div>
@endsection
