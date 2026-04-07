@extends('layout.home')

@section('body')

<div class="container mt-4">
    <div class="row">

        @forelse($products as $object)

            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card h-100 shadow-sm">

                    <img src="{{ $object->image }}"
                        class="card-img-top"
                        style="height:220px;object-fit:cover"
                        alt="{{ $object->name }}">

                    <div class="card-body d-flex flex-column">

                        <h5 class="card-title text-center fw-bold">
                            {{ $object->name }}
                        </h5>

                        <p class="card-text text-muted small text-center">
                            {{ Str::limit($object->description,80) }}
                        </p>

                        <div class="text-center mb-3">

                            <span class="badge border border-success text-success px-3 py-2 mb-2">
                                Còn {{ $object->stock }} sản phẩm
                            </span>

                            <br>

                            <span class="badge border border-primary text-primary px-3 py-2">
                                {{ number_format($object->price) }} VNĐ
                            </span>

                        </div>

                        <div class="mt-auto text-center">
                            <a href="{{ route('single_product',$object->id) }}"
                               class="btn btn-primary">
                                Detail Product
                            </a>
                        </div>

                    </div>

                </div>
            </div>

        @empty

            <div class="col-12 text-center">
                <h4>Không có sản phẩm</h4>
            </div>

        @endforelse

    </div>
</div>

@endsection