@extends('layout.home')

@section('body')
<section class="inner_page_head">
    <div class="container_fuild">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <h3>Phản hồi từ Admin</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="why_section layout_padding">
    <div class="container">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">Danh sách phản hồi</h5>
            </div>

            <div class="card-body">
                @forelse($contacts as $contact)
                    <div class="border rounded-3 p-3 mb-3 shadow-sm">
                        <h6 class="fw-bold text-danger">
                            {{ $contact->subject }}
                        </h6>

                        <p class="mb-2">
                            <strong>Bạn đã gửi:</strong><br>
                            {{ $contact->message }}
                        </p>

                        <p class="mb-2 text-success">
                            <strong>Admin phản hồi:</strong><br>
                            {{ $contact->reply }}
                        </p>

                        <small class="text-muted">
                            {{ \Carbon\Carbon::parse($contact->replied_at)->diffForHumans() }}
                        </small>
                    </div>
                @empty
                    <div class="text-center text-muted py-4">
                        Chưa có phản hồi nào từ admin
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection