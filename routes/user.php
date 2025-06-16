<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;


Route::middleware(['auth'])->prefix('user')->name('user.')->group(function(){
    Route::get('/dashboard', [UserController::class, 'index'])->name('index');
});