<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\OrderController;

Route::get('/login', [AuthController::class,'loginForm']);
Route::post('/login', [AuthController::class,'login']);

Route::middleware('auth.custom')->group(function () {

    Route::get('/logout', [AuthController::class,'logout']);

    Route::get('/products', [ProductController::class,'index'])->name('products');

    Route::get('/cart', [CartController::class,'index'])->name('cart');

    Route::post('/cart/add', [CartController::class,'add'])->name('cart.add');

    Route::post('/cart/remove/{id}', [CartController::class,'remove'])->name('cart.remove');

    Route::post('/checkout', [CheckoutController::class,'checkout'])->name('checkout');

    Route::get('/my-orders', [OrderController::class,'myOrders'])->name('my.orders');

    Route::get('/order/{id}', [OrderController::class,'show'])->name('order.show');

    Route::middleware('admin.custom')->group(function () {

        Route::get('/admin/orders', [AdminOrderController::class,'index'])->name('admin.orders');

    });

});

Route::get('/', function () {
    return redirect('/login');
});