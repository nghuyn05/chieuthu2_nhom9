@extends('layout/admin')

@section('body')
<div class="card shadow mb-4">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">Chỉnh sửa About</h5>
    </div>

    <div class="card-body bg-light">
        <form action="{{ route('admin.about.update', ['about' => $about->id]) }}"
              method="post"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Tiêu đề</label>
                    <input type="text"
                           name="title"
                           class="form-control"
                           value="{{ $about->title }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Nội dung 1</label>
                    <textarea name="content_1"
                              class="form-control"
                              rows="5">{{ $about->content_1 }}</textarea>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Nội dung 2</label>
                    <textarea name="content_2"
                              class="form-control"
                              rows="5">{{ $about->content_2 }}</textarea>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Nội dung 3</label>
                    <textarea name="content_3"
                              class="form-control"
                              rows="5">{{ $about->content_3 }}</textarea>
                </div>

                <div class="col-md-8 mb-3">
                    <label class="form-label fw-bold">Link hình ảnh</label>
                    <input type="text"
                           name="image"
                           class="form-control"
                           value="{{ $about->image }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Trạng thái</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ $about->status == 1 ? 'selected' : '' }}>
                            Hiển thị
                        </option>
                        <option value="0" {{ $about->status == 0 ? 'selected' : '' }}>
                            Ẩn
                        </option>
                    </select>
                </div>
            </div>

            @if($about->image)
                <div class="mb-3">
                    <label class="form-label fw-bold">Xem trước hình</label><br>
                    <img src="{{ $about->image }}" class="img-thumbnail" style="max-height:180px">
                </div>
            @endif

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.about.index') }}" class="btn btn-secondary">
                    Quay lại
                </a>
                <button type="submit" class="btn btn-primary">
                    Lưu thay đổi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
