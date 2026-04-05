<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\CommentController;
use App\Http\Controllers\admin\RatingController;
use App\Http\Controllers\admin\CartsController;
use App\Http\Controllers\admin\AddressController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\HomeController;


Route::get('/users', function () {

    $users = User::all();

    return response()->json([
        "status" => "success",
        "data" => $users
    ]);

});

Route::get('/users/{id}', function ($id) {

    $user = User::find($id);

    return response()->json([
        "status" => "success",
        "data" => $user
    ]);

});

Route::get('/login', [HomeController::class, 'loginApiGet']);
Route::get('/register', [HomeController::class, 'registerApiGet']);

Route::get('/search', [HomeController::class, 'searchApi'])->name('api.search');

// API lấy tất cả category
Route::get('/category/{id}', [HomeController::class, 'apiProductsByCategory']);
Route::get('/category', [HomeController::class, 'apiCategory']);


Route::get('/product', [HomeController::class, 'productApi']);

//Lien he
Route::prefix('home')->group(function () {
    Route::post('/contact', [HomeController::class, 'apiSubmitContact']);
    Route::get('/contact/replies', [HomeController::class, 'apiGetReplies']);
});

Route::apiResource('products', ProductController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('orders', OrderController::class);
Route::apiResource('customers', CustomerController::class);
Route::apiResource('comments', CommentController::class);
Route::apiResource('ratings', RatingController::class);
Route::apiResource('carts', CartsController::class);
Route::apiResource('addresses', AddressController::class);
Route::apiResource('contacts', ContactController::class);


?>