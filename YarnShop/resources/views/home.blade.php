@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>

    {{-- CONTACT FORM --}}
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header text-center fw-bold">
                    Liên hệ {{-- ✅ SỬA --}}
                </div>

                <div class="card-body p-4">

                    {{-- Thông báo --}}
                    @if(session('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- FORM --}}
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Họ và tên</label> {{-- ✅ --}}
                            <input type="text" 
                                   name="name" 
                                   class="form-control rounded-3" 
                                   value="{{ old('name') }}" 
                                   placeholder="Nhập họ và tên"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" 
                                   name="email" 
                                   class="form-control rounded-3" 
                                   value="{{ old('email') }}" 
                                   placeholder="Nhập email"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tiêu đề</label> {{-- ✅ --}}
                            <input type="text" 
                                   name="subject" 
                                   class="form-control rounded-3" 
                                   value="{{ old('subject') }}" 
                                   placeholder="Nhập tiêu đề"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nội dung</label> {{-- ✅ --}}
                            <textarea name="message" 
                                      class="form-control rounded-3" 
                                      rows="4"
                                      placeholder="Nhập nội dung"
                                      required>{{ old('message') }}</textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark rounded-3">
                                Gửi liên hệ {{-- ✅ --}}
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection