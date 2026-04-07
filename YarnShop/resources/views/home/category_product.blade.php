@extends('layout/home')

@section('body')

<!-- inner page section -->
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
<!-- end inner page section -->

<div class="container my-4">
    <div class="row">
        <div class="col-12">
            <!-- Nơi hiển thị sản phẩm -->
            <div class="row" id="product-list">
                <!-- JavaScript sẽ render dữ liệu vào đây -->
            </div>
        </div>
    </div>
</div>

<script>
    // Hiển thị loading khi đang tải
    document.getElementById('product-list').innerHTML = `
        <div class="col-12 text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Đang tải sản phẩm...</p>
        </div>
    `;

    fetch('http://127.0.0.1:8000/api/category/1')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            let html = '';

            if (data.data && data.data.length > 0) {
                data.data.forEach(p => {
                    html += `
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="${p.image || 'https://via.placeholder.com/300x220?text=No+Image'}" 
                                 class="card-img-top img-fluid" 
                                 style="height: 220px; object-fit: cover;" 
                                 alt="${p.name}">
                            
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-center fw-bold">${p.name}</h5>
                                
                                <p class="card-text text-muted small text-center">
                                    ${p.description ? p.description.substring(0, 80) + '...' : 'Không có mô tả'}
                                </p>

                                <p class="text-center mb-3">
                                    <span class="badge border border-success text-success px-3 py-2 me-2">
                                        Còn ${p.stock || 0} sản phẩm
                                    </span>
                                    <span class="badge border border-success text-success px-3 py-2">
                                        ${Number(p.price || 0).toLocaleString('vi-VN')} VNĐ
                                    </span>
                                </p>

                                <div class="mt-auto text-center">
                                    <a href="/product/${p.id}" 
                                       class="btn btn-primary px-4">
                                        Chi tiết sản phẩm
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>`;
                });
            } else {
                html = `
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">Không có sản phẩm nào trong danh mục này.</p>
                    </div>`;
            }

            document.getElementById('product-list').innerHTML = html;
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('product-list').innerHTML = `
                <div class="col-12 text-center py-5 text-danger">
                    <p>Lỗi khi tải dữ liệu. Vui lòng thử lại sau.</p>
                    <button onclick="location.reload()" class="btn btn-outline-primary mt-3">
                        Thử lại
                    </button>
                </div>`;
        });
</script>

@endsection