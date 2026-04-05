@extends('layout/home')
@section('body')
<!-- inner page section -->
<section class="inner_page_head">
    <div class="container_fuild">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <h3>Liên hệ</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end inner page section -->

<section class="why_section layout_padding">
    <div class="container">

        @if($contact && $contact->description)
            <div class="row mb-4">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <p class="text-muted">
                        {{ $contact->description }}
                    </p>
                </div>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-6">

                <div class="card shadow-lg border-0 rounded-4 p-4">
                    <h5 class="text-center mb-4 fw-bold">Gửi liên hệ cho chúng tôi</h5> {{-- ✅ SỬA --}}

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
                            <label class="form-label">Họ và tên</label> {{-- ✅ SỬA --}}
                            <input type="text" 
                                   name="name" 
                                   class="form-control rounded-3" 
                                   placeholder="Nhập họ và tên"
                                   value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" 
                                   name="email" 
                                   class="form-control rounded-3" 
                                   placeholder="Nhập email"
                                   value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tiêu đề</label> {{-- ✅ SỬA --}}
                            <input type="text" 
                                   name="subject" 
                                   class="form-control rounded-3" 
                                   placeholder="Nhập tiêu đề"
                                   value="{{ old('subject') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nội dung</label> {{-- ✅ SỬA --}}
                            <textarea name="message" 
                                      class="form-control rounded-3" 
                                      rows="4"
                                      placeholder="Nhập nội dung" required>{{ old('message') }}</textarea>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-dark rounded-3 py-2 px-4">
                                Gửi liên hệ
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        {{-- INFO --}}
        <div class="row mt-5">
            <div class="col-md-4 text-center">
                <h6 class="fw-bold">Address</h6>
                <p class="text-muted">
                    180 Cao Lỗ, Phường 4,<br>
                    Quận 8, TP.HCM
                </p>
            </div>

            <div class="col-md-4 text-center">
                <h6 class="fw-bold">Phone</h6>
                <p class="text-muted">
                    +84 866 496 437
                </p>
            </div>

            <div class="col-md-4 text-center">
                <h6 class="fw-bold">Email</h6>
                <p class="text-muted">
                    minhngoc1907204@gmail.com
                </p>
            </div>
        </div>

    </div>
</section>

@endsection