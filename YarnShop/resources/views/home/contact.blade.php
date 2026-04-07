@extends('layout/home')
@section('body')

<section class="inner_page_head">
    <div class="container_fuild">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <h3>{{ $contact->title ?? 'Contact us' }}</h3>
                </div>
            </div>
        </div>
    </div>
</section>

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

        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="full">

                    {{-- Thông báo --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- FORM GIỮ NGUYÊN --}}
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <fieldset>
                            <input type="text" name="name" placeholder="Enter your full name" required>
                            <input type="email" name="email" placeholder="Enter your email address" required>
                            <input type="text" name="subject" placeholder="Enter subject" required>
                            <textarea name="message" placeholder="Enter your message" required></textarea>
                            <input type="submit" value="Submit">
                        </fieldset>
                    </form>

                </div>
            </div>
        </div>

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
