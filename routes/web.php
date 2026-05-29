<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return to_route('user.dashboard');
});

Route::get('/dashboard', [UserController::class,'index'])->name('user.dashboard');
Route::get('/shop/{category_id?}/{product_id?}', [UserController::class,'shop'])->name('user.shop');
Route::get('/details/{productVariant_id}', [UserController::class,'shopDetails'])->name('user.details');
Route::get('/contact', [UserController::class, 'contact'])->name('user.contact');
Route::post('/cart/update-quantity', [UserController::class, 'updateQuantity']);


Route::middleware('auth')->group(function () {
    Route::post('/review', [UserController::class,'review'])->name('user.review');
    Route::get('/cart', [UserController::class, 'cart'])->name('user.cart');
    Route::post('/cart', [UserController::class, 'storeCart'])->name('user.cart.store');
    Route::get('/remove/cart', [UserController::class, 'removeCart'])->name('user.remove.cart');
    Route::get('/order', [ UserController::class, 'order'])->name('user.order');
    Route::get('/user/order/{id}', [UserController::class, 'orderShow'])->name('user.order.show');    
    Route::post('/order', [ UserController::class, 'storeOrder'])->name('user.order.store');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require base_path('routes/admin.php');
require __DIR__.'/auth.php';
