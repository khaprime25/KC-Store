<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\OrderController;

Route::middleware(['auth', 'admin'])->prefix('admin')->as('admin.')->group(function () {
    // Dashboard Section
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('users', [AdminController::class, 'users'])->name('users');
    Route::get('users/promote/{user_id}', [AdminController::class, 'promote'])->name('users.promote');
    Route::get('users/demote/{user_id}', [AdminController::class, 'demote'])->name('users.demote');
    Route::get('order', [OrderController::class, 'index'])->name('order.index');
    Route::get('order/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::put('/orders/{id}/confirm', [OrderController::class, 'confirm'])->name('order.confirm');
    Route::put('/orders/{id}/deliver', [OrderController::class, 'deliver'])->name('order.deliver');
    Route::put('/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('order.cancel');
    Route::resource('payment', PaymentController::class);

    // Category Section
    Route::resource('category', CategoryController::class);
    // Product Section
    Route::get('category/{category}/products/', [ProductController::class, 'getAllProducts'])->name('category.product.getAllProducts');
    Route::resource('category/{category}/product', ProductController::class)->names([
        'index' => 'category.product.index',
        'create' => 'category.product.create',
        'store' => 'category.product.store',
        'edit' => 'category.product.edit',
        'update' => 'category.product.update',
        'destroy' => 'category.product.destroy',
    ]);
    // Product Variants Section
    Route::get('category/product/productVariant', [ProductVariantController::class, 'getAllProductVariants'])->name('category.product.ProductVariant.getAllProductVariants');
    Route::resource('category/{category}/product/{product}/productVariant', ProductVariantController::class)->names([
        'index' => 'category.product.productVariant.index',
        'create' => 'category.product.productVariant.create',
        'store' => 'category.product.productVariant.store',
        'show' => 'category.product.productVariant.show',
        'edit' => 'category.product.productVariant.edit',
        'update' => 'category.product.productVariant.update',
        'destroy' => 'category.product.productVariant.destroy',
    ]);


});
