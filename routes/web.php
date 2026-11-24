<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

Route::get('/tentang', AboutController::class)
    ->name('about');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('products', ProductController::class);
});
    
require __DIR__.'/settings.php';
