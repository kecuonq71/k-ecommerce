<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Middleware\AuthAdmin;

Route::middleware(['auth', AuthAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    //Route for Brands
    Route::prefix('brands')->name('brands.')->group(function () {
        Route::get('/', [BrandController::class, 'index'])->name('index');
        Route::get('/create', [BrandController::class, 'create'])->name('create');
        Route::post('/store', [BrandController::class, 'store'])->name('store');
        Route::get('/show/{brand}', [BrandController::class, 'show'])->name('show');
        Route::get('/edit/{brand}', [BrandController::class, 'edit'])->name('edit');
        Route::put('/update/{brand}', [BrandController::class, 'update'])->name('update');
        Route::delete(('/destroy/{brand}'), [BrandController::class, 'destroy'])->name('destroy');
    });

    //Route for Categories
    Route::prefix('categories')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/show/{category}', [CategoryController::class, 'show'])->name('show');
        Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/update/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete(('/destroy/{category}'), [CategoryController::class, 'destroy'])->name('destroy');
    });

    //Route for Products
    Route::resource('products', ProductController::class)->names('product');
});
