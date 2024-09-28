<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::resource('category', CategoryController::class)->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/category', [CategoryController::class, 'index'])->name('category.get');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.create');
    Route::patch('/category', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category', [CategoryController::class, 'destroy'])->name('category.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
