<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

Route::get('/logout', function() {
    Auth::logout();

    return redirect('/');
})->name('logout');


Route::get('/login', function() {
    return redirect('/login');
})->name('login_page');

Route::prefix('/')->group(function() {
    Route::get('', function() {
        return view('user.home');
    })->name('user.home');

    Route::get('/products', [ProductController::class, 'index'])->name('user.products');
    Route::get('/product/{id}', [ProductController::class, 'detail'])->name('user.product');
    Route::get('/products/search', [ProductController::class, 'search'])->name('user.search');

    Route::middleware(['auth'])->group(function() {
    Route::post('/order/{id}', [OrderController::class, 'order'])->name('user.order');
        Route::get('orders', [OrderController::class, 'orders'])->name('user.orders');
    });

});

Route::prefix('/admin')->middleware(['auth', 'admin'])->group(function() {
    Route::get('', function () {
        return view('admin.home');
    })->name('admin.home');

    Route::get('/products', [ProductController::class, 'index'])->name('admin.products');
    Route::get('/product/{id}', [ProductController::class, 'detail'])->name('admin.product');
    Route::get('/products/search', [ProductController::class, 'search'])->name('admin.search');
    Route::get('add-product', [ProductController::class, 'create'])->name('admin.create_product_form');
    Route::post('add-product', [ProductController::class, 'store'])->name('admin.create_product');
    Route::delete('delete-product/{id}', [ProductController::class, 'destroy'])->name('admin.delete_product');
    Route::get('edit-product/{id}', [ProductController::class, 'edit'])->name('admin.edit_form');
    Route::put('edit-product/{id}', [ProductController::class, 'update'])->name('admin.update_product');

    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::get('orders/search', [OrderController::class, 'search'])->name('admin.search_orders');
    Route::get('/orders/{query}', [OrderController::class, 'filter'])->name('admin.orders_filter');
    Route::put('/order/paid/{id}', [OrderController::class, 'paid'])->name('admin.paid');
    Route::put('/order/ready/{id}', [OrderController::class, 'ready'])->name('admin.ready');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
