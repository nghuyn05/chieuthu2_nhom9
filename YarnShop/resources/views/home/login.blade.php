@extends('layout.home')
@section('body')

<div class="login-wrapper">
    <div class="login-card">
        <h3>
            {{ request()->routeIs('user.register.form') ? 'Đăng ký' : 'Đăng nhập' }}
        </h3>

        {{-- LOGIN FORM --}}
        @if(request()->routeIs('user.login.form'))
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('user.login') }}">
                @csrf

                <div class="field-group">
                    <label>Email</label>
                    <input type="email" name="email"
                           placeholder="abc@gmail.com"
                           value="{{ old('email') }}"
                           autocomplete="off"
                           autocapitalize="none"
                           spellcheck="false"
                           required>
                </div>

                <div class="field-group">
                    <label>Mật khẩu</label>
                    <input type="password" name="password"
                           placeholder="••••••••"
                           required>
                </div>

                <button type="submit" class="btn-login">Đăng nhập</button>
            </form>

            <div class="divider">hoặc</div>

            <p class="register-link">
                Chưa có tài khoản?
                <a href="{{ route('user.register.form') }}">Đăng ký ngay</a>
            </p>
        @endif


        {{-- REGISTER FORM --}}
        @if(request()->routeIs('user.register.form'))
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                        <p>{{ $err }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('user.register') }}">
                @csrf

                <div class="field-group">
                    <label>Họ tên</label>
                    <input type="text" name="name"
                           placeholder="Nguyễn Văn A"
                           value="{{ old('name') }}"
                           required>
                </div>

                <div class="field-group">
                    <label>Email</label>
                    <input type="email" name="email"
                           placeholder="abc@gmail.com"
                           value="{{ old('email') }}"
                           autocomplete="off"
                           autocapitalize="none"
                           spellcheck="false"
                           required>
                </div>

                <div class="field-group">
                    <label>Mật khẩu</label>
                    <input type="password" name="password"
                           placeholder="••••••••"
                           required>
                </div>

                <button type="submit" class="btn-register">Đăng ký</button>
            </form>

            <div class="divider">hoặc</div>

            <p class="login-link">
                Đã có tài khoản?
                <a href="{{ route('user.login.form') }}">Đăng nhập</a>
            </p>
        @endif
    </div>
</div>
@endsection