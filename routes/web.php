<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ProfileController as ApiProfileController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserAuthController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'Language'], function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/product-detail/{slug}', [HomeProductController::class, 'detail'])->name('detail');
    Route::get('/all-product', [HomeProductController::class, 'allProduct'])->name('allProduct');
    Route::get('/profile', [ProfileController::class, 'dashboard'])->name('profile');

    // product by category
    Route::get('/category/{slug}', [CategoryProductController::class, 'index'])->name('categoryProduct');
    Route::get('/category/detail/{slug}', [CategoryProductController::class, 'detail'])->name('categoryProductDetail');

    // admin auth
    Route::get('/loginPage', [PageController::class, 'showLogin'])->name('adminLoginPage');
    Route::post('login', [PageController::class, 'login'])->name('adminLogin');
});




// api
Route::post('/api/add-to-cart', [CartController::class, 'addToCart'])->name('addToCart');
Route::post('/api/add-cart', [CartController::class, 'addCart'])->name('addCart');
Route::post('/api/sub-cart', [CartController::class, 'subCart'])->name('subCart');
Route::post('/api/make-review', [ReviewController::class, 'makeReview'])->name('makeReview');
Route::get('/api/cart', [CartController::class, 'getCart'])->name('getCart');
Route::post('/api/checkout-cart', [CartController::class, 'checkOut'])->name('checkOut');
// profile api
Route::post('/api/change-password', [ApiProfileController::class, 'changePassword'])->name('changePassword');

// order api
Route::get('/api/order', [CartController::class, 'order'])->name('order');

// localization
Route::get('/language/{lang}', [HomeController::class, 'switchLanguage'])->name('switchLanguage');


// user auth
Route::get('registerPage', [UserAuthController::class, 'index'])->name('registerPage');
Route::post('register', [UserAuthController::class, 'register'])->name('register');

Route::get('user/loginPage', [UserAuthController::class, 'loginPage'])->name('loginPage');
Route::post('user/login', [UserAuthController::class, 'login'])->name('login');
Route::post('user/logout', [UserAuthController::class, 'logout'])->name('logout');

// client home page



// admin dashboard
Route::group(['prefix' => 'admin', 'middleware' => 'AdminAuth'], function () {
    Route::get('/dashboard', [PageController::class, 'showDashboard'])->name('adminDashboard');
    Route::post('/logout', [PageController::class, 'logout'])->name('adminLogout');

    // Route::get('category/create', [CategoryController::class, 'createPage'])->name('categoryCreatePage');
    Route::resource('/category', CategoryController::class);
    // product
    Route::resource('/product', ProductController::class);
    Route::get('/create-product-add/{slug}', [ProductController::class, 'createProductAdd'])->name('createProductAdd');
    Route::get('/create-product-reduce/{slug}', [ProductController::class, 'createProductReduce'])->name('createProductReduce');

    Route::post('/store-product-add/{slug}', [ProductController::class, 'storeProductAdd'])->name('storeProductAdd');
    Route::post('/store-product-reduce/{slug}', [ProductController::class, 'storeProductReduce'])->name('storeProductReduce');
    Route::get('/product-transaction', [ProductController::class, 'productTransaction'])->name('productTransaction');
    // trend
    Route::post('/product/trend', [ProductController::class, 'trend'])->name('trend');

    // brand
    Route::resource('/brand', BrandController::class);

    // order
    Route::get('/order', [OrderController::class, 'index'])->name('order');
    Route::post('/order/change-order-status', [OrderController::class, 'changeStatus'])->name('changeStatus');
});
