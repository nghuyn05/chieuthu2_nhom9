@extends('layout.admin')
@section('body')

<h3>Phản hồi liên hệ</h3>

<form action="{{ route('admin.contact.sendReply', $contact->id) }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="fw-bold">Email khách hàng:</label>
        <input type="text" class="form-control" value="{{ $contact->email }}" readonly>
    </div>
    <div class="mb-3">
        <label class="fw-bold">Nội dung phản hồi:</label>
        <textarea name="reply" class="form-control" rows="5" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Gửi phản hồi</button>
    <a href="{{ route('admin.contact.index') }}" class="btn btn-secondary">Hủy</a>
</form>

@endsection
