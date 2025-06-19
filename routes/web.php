<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\ShopController;
use App\Http\Controllers\User\CartController;

use Illuminate\Support\Facades\Route;


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::prefix('shop')->name('shop.')->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('index');
    Route::get('/product/{slug}', [ShopController::class, 'productDetail'])->name('product.detail');
});

Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'add_to_cart'])->name('add');
    Route::put('/increase_quantity/{id}', [CartController::class, 'increase_cart_quantity'])->name('increase_quantity');
    Route::put('/decrease_quantity/{id}', [CartController::class, 'decrease_cart_quantity'])->name('decrease_quantity');
    Route::delete('remove/{id}', [CartController::class, 'remove_item'])->name('remove');
    Route::delete('/clear', [CartController::class, 'clear_cart'])->name('clear');
        
    
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/user.php';
