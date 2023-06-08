<?php

use App\Http\Controllers\Api\CartApiController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\HomeApiController;
use App\Http\Controllers\Api\ProductDetailApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('home', [HomeApiController::class, 'home'])->name('homeApi');
Route::get('product-detail/{slug}', [ProductDetailApiController::class, 'detail'])->name('productDetailApi');
Route::post('add-to-cart/{slug}', [CartApiController::class, 'addToCart'])->name('cartApi');
