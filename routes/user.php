<?php

use App\Http\Controllers\Shop\ShopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;


Route::middleware(['auth'])->prefix('user')->name('user.')->group(function(){
    Route::get('/dashboard', [UserController::class, 'index'])->name('index');

    //Route for shop
    // Route::prefix('shop')->name('shop.')->group(function () {
    //     Route::get('/', [ShopController::class, 'index'])->name('index');
    //     Route::get('/product/{slug}', [ShopController::class, 'productDetail'])->name('product.detail');
    // });


});