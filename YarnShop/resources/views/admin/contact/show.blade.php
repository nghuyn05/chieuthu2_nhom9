@extends('layout.admin')
@section('body')

<div class="card shadow">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">Chi tiết liên hệ</h5>
    </div>

    <div class="card-body">

        <div class="mb-3">
            <label class="fw-bold">Họ tên:</label>
            <div class="form-control bg-light">{{ $contact->name }}</div>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Email:</label>
            <div class="form-control bg-light">{{ $contact->email }}</div>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Tiêu đề:</label>
            <div class="form-control bg-light">{{ $contact->subject }}</div>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Nội dung:</label>
            <textarea class="form-control bg-light" rows="5" readonly>{{ $contact->message }}</textarea>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Trạng thái:</label>
            @if($contact->status == 0)
                <span class="badge bg-danger">Chưa đọc</span>
            @else
                <span class="badge bg-success">Đã đọc</span>
            @endif
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.contact.index') }}" class="btn btn-secondary">
                Quay lại
            </a>

            <form action="{{ route('admin.contact.destroy', $contact->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger"
                        onclick="return confirm('Bạn chắc chắn muốn xóa liên hệ này?')">
                    Xóa
                </button>
            </form>
            <a href="{{ route('admin.contact.reply', $contact->id) }}" class="btn btn-primary">Phản hồi</a>

        </div>

    </div>
</div>

@endsection
