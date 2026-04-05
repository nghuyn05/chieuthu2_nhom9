<!DOCTYPE html>
<html>
<head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Yarn shop</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" />
      <!-- font awesome style -->
      <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
      <!--Icon Contact -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
      
   </head>
<body>

<!-- ================= TOPBAR ================= -->
<div class="container-fluid px-5 py-4 d-none d-lg-block">
    <div class="row align-items-center">

        <!-- LOGO -->
        <div class="col-md-3">
            <a href="/" class="navbar-brand">
                <img width="140" src="{{ asset('images/logo.png') }}">
            </a>
        </div>

        <!-- SEARCH -->
         <div class="col-md-6 position-relative">

            <div class="d-flex border rounded-pill align-items-center px-2">

               <input 
                     type="text" 
                     id="search-input"
                     class="form-control border-0 bg-transparent"
                     placeholder="Tìm sản phẩm..."
               >

               <!-- icon search -->
               <button type="button" class="btn btn-pink" onclick="handleSearch()">
                  <i class="fa fa-search"></i>
               </button>

            </div>

            <!-- RESULT BOX -->
            <div id="search-result" class="search-result-box"></div>

         </div>

        <!-- ICON -->
        <div class="col-md-3 text-end">

            <!-- LOGIN -->
            @if(session('customer'))
                <span>{{ session('customer.name') }}</span> |
                <a href="{{ route('user.logout') }}">Đăng xuất</a>
            @else
                <a href="{{ route('user.login.form') }}">Đăng nhập</a>
            @endif

            <!-- CART -->
            <a href="{{ route('cart.index') }}" class="ml-3">
                <i class="fa fa-shopping-cart"></i>
            </a>

            <!-- Reply Notification -->
            <div class="reply-wrapper d-inline-block position-relative ml-3">
               <a href="javascript:void(0)" id="admin-reply-btn" class="reply-icon">
                  <i class="bi bi-envelope-heart-fill"></i>

                  @if($replyCount > 0)
                     <span class="reply-badge">{{ $replyCount }}</span>
                  @endif
               </a>

               <div id="admin-reply-box" class="reply-dropdown">
                  <div class="reply-header">
                     <span>📩 Phản hồi từ Admin</span>
                     <small>{{ $replyCount }} phản hồi</small>
                  </div>

                  @forelse($replies as $reply)
                     <div class="reply-item">
                        <div class="reply-avatar">A</div>
                        <div class="reply-content">
                           <strong>{{ $reply->subject }}</strong>
                           <p>{{ Str::limit($reply->reply, 60) }}</p>
                           <small>
                              {{ \Carbon\Carbon::parse($reply->replied_at)->diffForHumans() }}
                           </small>
                        </div>
                     </div>
                  @empty
                     <div class="p-3 text-center text-muted">
                        Chưa có phản hồi nào
                     </div>
                  @endforelse

                  <div class="reply-footer">
                     <a href="{{ route('home.reply') }}">Xem phản hồi</a>
                  </div>
               </div>
            </div>

        </div>

    </div>
</div>

<!-- ================= MENU ================= -->
<div class="container-fluid menu-bar">
    <div class="row align-items-center">

        <!-- CATEGORY -->
        <div class="col-lg-3 position-relative">
            <div class="category-btn" data-toggle="collapse" data-target="#catMenu">
                <i class="fa fa-bars"></i> Danh mục sản phẩm
            </div>

            <div id="catMenu" class="collapse category-dropdown">
                <ul>
                    @foreach($categories as $object)
                        <li>
                            <a href="{{ route('category_product', $object->id) }}">
                                {{ $object->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- MENU -->
        <div class="col-lg-9">
            <ul class="menu-right">
                <li><a href="/">Trang chủ</a></li>
                <li><a href="/product">Sản phẩm</a></li>
                <li><a href="{{ route('contact') }}">Liên hệ</a></li>
            </ul>
        </div>
    </div>
</div>

{{-- ✅ ALERT Ở ĐÂY (chuẩn nhất) --}}
@if(session('success'))
    <div id="alert-box" class="custom-alert">
      {{ session('success') }}
      <span onclick="this.parentElement.style.display='none'" style="margin-left:10px; cursor:pointer;">✖</span>
   </div>

    <script>
        setTimeout(() => {
            document.getElementById('alert-box').style.display = 'none';
        }, 3000);
    </script>
@elseif(session('error'))
     <div id="alert-box" class="custom-alert">
      {{ session('error') }}
      <span onclick="this.parentElement.style.display='none'" style="margin-left:10px; cursor:pointer;">✖</span>
   </div>
    <script>
        setTimeout(() => {
            document.getElementById('alert-error').style.display = 'none';
        }, 3000);
    </script>
@endif
<!-- ================= BODY ================= -->
@yield('body')

<!-- ================= FOOTER ================= -->
      <!-- footer start -->
      <footer>
         <div class="container">
            <div class="row">
               <div class="col-md-4">
                   <div class="full">
                      <div class="logo_footer">
                        <a href="#"><img width="210" src="{{ asset('images/logo.png') }}" alt="#" /></a>
                      </div>
                      <div class="information_f">
                        <p><strong>ADDRESS:</strong> 180 Cao Lỗ , Phường 4 , Quận 8 , TPHCM</p>
                        <p><strong>TELEPHONE:</strong> +84 866 496 437</p>
                        <p><strong>EMAIL:</strong> minhngoc1907204@gmail.com</p>
                      </div>
                   </div>
               </div>
               <div class="col-md-8">
                  <div class="row">
                  <div class="col-md-7">
                     <div class="row">
                        <div class="col-md-6">
                     <div class="widget_menu">
                        <h3>Menu</h3>
                        <ul>
                           <li><a href="{{ route('home') }}">Trang chủ</a></li>
                           <li><a href="{{ route('category_product',1) }}">Danh mục sản phẩm</a></li>
                           <li><a href="{{ route('product',1) }}">Sản phẩm</a></li>                           
                           <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="widget_menu">
                        <h3>Tài khoản</h3>
                        <ul>                           
                           <li><a href="{{ route('user.login') }}">Đăng nhập</a></li>
                           <li><a href="{{ route('user.register') }}">Đăng ký</a></li>
                           <li><a href="{{ route('cart.index') }}">Giỏ hàng</a></li>
                           <li><a href="{{ route('checkout') }}">Thanh Toán</a></li>
                        </ul>
                     </div>
                  </div>
                     </div>
                  </div>     
                  <div class="col-md-5">
                     <div class="widget_menu">
                        <h3>Bản tin</h3>
                        <div class="information_f">
                          <p>Đăng ký nhận bản tin để cập nhật thông tin mới nhất và các ưu đãi đặc biệt.</p>
                        </div>
                        <div class="form_sub">
                           <form>
                              <fieldset>
                                 <div class="field">
                                    <input type="email" placeholder="Nhập email của bạn" name="email" />
                                    <input type="submit" value="Đăng ký" />
                                 </div>
                              </fieldset>
                           </form>
                        </div>
                     </div>
                  </div>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!-- footer end -->

<div class="cpy_">
         <p class="mx-auto">
             2026 Yarn Shop. Developed by Nhóm 9 – [ Xây dựng phần mềm Web ]
         </p>
      </div>
      <!-- jQery -->
      <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
      <!-- popper js -->
      <script src="{{ asset('js/popper.min.js') }}"></script>
      <!-- bootstrap js -->
      <script src="{{ asset('js/bootstrap.js') }}"></script>
      <!-- custom js -->
      <script src="{{ asset('js/custom.js') }}"></script>
      <script>
         let currentIndex = 0;
         const itemsPerView = 3;

         function slideRight() {
            const items = document.querySelectorAll('.featured-item');
            const maxIndex = items.length - itemsPerView;

            if (currentIndex >= maxIndex) {
               currentIndex = 0; // quay về đầu
            } else {
               currentIndex++;
            }
            updateSlide();
         }

         function slideLeft() {
            const items = document.querySelectorAll('.featured-item');
            const maxIndex = items.length - itemsPerView;

            if (currentIndex <= 0) {
               currentIndex = maxIndex; // nhảy về cuối
            } else {
               currentIndex--;
            }
            updateSlide();
         }

         function updateSlide() {
            const itemWidth = document.querySelector('.featured-item').offsetWidth;
            document.getElementById('featuredTrack').style.transform =
               `translateX(-${currentIndex * itemWidth}px)`;
         }
         function handleSearch() {
            const keyword = document.getElementById("search-input").value.trim();

            if (keyword === "") return;

            // redirect giống Enter
            window.location.href = "/search?keyword=" + encodeURIComponent(keyword);
         }
         document.getElementById("search-input").addEventListener("keydown", function(e) {
            if (e.key === "Enter") {
               e.preventDefault(); // tránh hành vi mặc định
               handleSearch();
            }
         });
         

         // reply
         document.getElementById("admin-reply-btn").onclick = function() {
            let box = document.getElementById("admin-reply-box");
            box.style.display = (box.style.display === "block") ? "none" : "block";
         };

         // click ngoài thì đóng
         document.addEventListener("click", function(e){
            if(!e.target.closest(".reply-wrapper")){
               document.getElementById("admin-reply-box").style.display = "none";
            }
         });
</script>
</body>
</html>