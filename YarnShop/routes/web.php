<?php

use App\Http\Controllers\admin\AboutController;
use App\Http\Controllers\admin\AddressController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CartsController as AdminCartsController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CommentController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\RatingController;
use App\Http\Controllers\admin\CartsController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\OrderItemController;
use App\Http\Controllers\HomeController;
use Dom\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;


Route::get('/', [App\Http\Controllers\HomeController::class,'index'])->name('home');

Route::get('/user-login', [HomeController::class, 'showLogin'])->name('user.login.form');
Route::post('/user-login', [HomeController::class, 'loginUser'])->name('user.login');
Route::get('/user-register', [HomeController::class, 'showRegister'])->name('user.register.form');
Route::post('/user-register', [HomeController::class, 'registerUser'])->name('user.register');
Route::get('/user-logout', [HomeController::class, 'logoutUser'])->name('user.logout');
Route::get('/search', [HomeController::class, 'search'])->name('product.search');

Route::get('/category_product/{category}', [App\Http\Controllers\HomeController::class,'category_product'])->name('category_product');
Route::get('/category_product/single_product/{category}', [App\Http\Controllers\HomeController::class,'single_product'])->name('single_product');
Route::get('/about', [HomeController::class, 'about'])->name('about');


// ===== ✅ CONTACT (ĐÃ SỬA) =====

// Route form contact
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Route xử lý gửi contact
Route::post('/contact', [HomeController::class, 'contactSubmit'])->name('contact.submit');

//Route cho user xem phản hồi
Route::get('/home/reply', [HomeController::class, 'myContact'])->name('home.reply');
// ===============================================


Route::get('/product', [App\Http\Controllers\HomeController::class,'product'])->name('product');
Route::get('/product/{id}', [App\Http\Controllers\HomeController::class,'single_product'])->name('product.show');
Route::get('/cart', [HomeController::class, 'cart'])->name('cart.index');
Route::get('/cart/add/{id}', [HomeController::class, 'addToCart'])->name('cart.add');
Route::get('/add-to-cart/{id}', [HomeController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/remove/{id}', [HomeController::class, 'removeFromCart'])->name('cart.remove');
Route::put('/cart/update/{id}', [HomeController::class, 'updateCart'])->name('cart.update');
Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [HomeController::class, 'processCheckout'])->name('checkout.process');

Route::get('/my-order/{id}', [HomeController::class, 'myOrder'])->name('order.view');


// ADMIN
Route::group(['prefix' => 'admin', 'as' => 'admin.','middleware' => 'auth'],function(){
    Route::resource('dashboard', AdminController::class);
    Route::resource('category',CategoryController::class);
    Route::resource('products_management',ProductController::class);
    Route::resource('comment',CommentController::class);
    Route::resource('customer_management',CustomerController::class);
    Route::resource('rating',RatingController::class);
    Route::resource('address',AddressController::class);
    Route::resource('order_management',OrderController::class);
    Route::resource('carts',CartsController::class);
    Route::resource('about',AboutController::class);
    Route::resource('contact',ContactController::class);
    Route::get('contact/{id}/reply', [ContactController::class, 'reply'])->name('contact.reply');
    Route::post('contact/{id}/reply', [ContactController::class, 'sendReply'])->name('contact.sendReply');
});

Route::get('/admin', action: function () {
    return view('admin.admin');
})->name('admin');
Auth::routes();

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/admin');
});

// ✅ FIX: xóa route trùng + chỉ giữ 1 cái
Route::get('/my-contact', [HomeController::class, 'myContact'])
    ->middleware('auth')
    ->name('user.contact');