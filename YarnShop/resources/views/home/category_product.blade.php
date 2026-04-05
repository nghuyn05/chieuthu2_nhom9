@extends('layout.home')

@section('body')
<section class="inner_page_head">
    <div class="container_fuild">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <h3>All Category</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container my-4">
    <div class="row" id="product-list">
        <!-- API render -->
    </div>
</div>

<script>
fetch('http://127.0.0.1:8000/api/category/1')
    .then(res => res.json())
    .then(data => {
        let html = '';

        data.data.forEach(p => {
            html += `
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="${p.image}" class="card-img-top img-fluid" style="height:220px; object-fit:cover;">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-center fw-bold">${p.name}</h5>

                            <p class="card-text text-muted small text-center product-desc">
                                ${p.description ?? ''}
                            </p>

                            <p class="text-center mb-3 product-badges">
                                <span class="badge border border-success text-success px-3 py-2">
                                    Còn ${p.stock} sản phẩm
                                </span>
                                <span class="badge border border-success text-success px-3 py-2">
                                    ${Number(p.price).toLocaleString()} VNĐ
                                </span>
                            </p>

                            <div class="mt-auto text-center">
                                <a href="/product/${p.id}" class="btn btn-secondary px-3">
                                    Detail Product
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                `;
        });

        document.getElementById('product-list').innerHTML = html;
    });
</script>
@endsection