@extends('layout.home')

@section('body')

<div class="login-wrapper">
    <div class="login-card">
        <h3>Đăng ký</h3>

        @if($errors->any())
            <div class="alert-danger">
                @foreach($errors->all() as $err)
                    <p>{{ $err }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('user.register') }}">
            @csrf

            <div class="field-group">
                <label for="name">Họ tên</label>
                <input type="text" id="name" name="name"
                       placeholder="Nguyễn Văn A"
                       value="{{ old('name') }}" required>
            </div>

            <div class="field-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email"
                       placeholder="ten@email.com"
                       value="{{ old('email') }}" required>
            </div>

            <div class="field-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password"
                       placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-register">Đăng ký</button>
        </form>

        <div class="divider">hoặc</div>

        <p class="login-link">
            Đã có tài khoản? <a href="{{ route('user.login') }}">Đăng nhập</a>
        </p>
    </div>
</div>
@endsection