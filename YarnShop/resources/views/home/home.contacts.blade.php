@extends('layout/home')
@section('body')
<div class="container mt-4">
    <h3>Phản hồi từ admin</h3>

    @forelse($contacts as $contact)
        <div class="card mb-3 p-3">
            <p><strong>Tiêu đề:</strong> {{ $contact->subject }}</p>
            <p><strong>Nội dung:</strong> {{ $contact->message }}</p>
            @if($contact->reply)
                <hr>
                <p><strong>Phản hồi từ admin:</strong> {{ $contact->reply }}</p>
            @endif
        </div>
    @empty
        <p>Chưa có phản hồi nào.</p>
    @endforelse
</div>
@endsection