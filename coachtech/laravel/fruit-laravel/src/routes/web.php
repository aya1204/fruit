<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//商品一覧
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/products/search',[ProductController::class, 'search'])->name('products.search');

//商品登録画面の表示
Route::get('/products/register', [ProductController::class, 'create'])->name('product.create');


//商品登録処理
Route::post('/products/register',[AuthController::class,'register'])->name('products.store');

//商品詳細
Route::get('/products/{productId}',[AdminController::class, 'show'])->name('admin.products.show');

//更新
Route::put('/products/{productId}/update', [AdminController::class,'update'])->name('products.update');

//削除
Route::delete('/products/{productId}/delete',[AdminController::class,'destroy'])->name('admin.destroy');