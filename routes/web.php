<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::post('products/by/ids', [ProductController::class, 'getByIds'])->name('products.index.ids');
Route::get('order', [OrderController::class, 'index'])->name('order.index');
Route::post('order', [OrderController::class, 'store'])->name('order.store');

Route::middleware(['auth'])->group(function () {
    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/delete/{id}', [AdminOrderController::class, 'delete'])->name('orders.delete');
});

Auth::routes(['register' => false, 'reset' => false, 'verify' => false, 'confirm' => false]);
