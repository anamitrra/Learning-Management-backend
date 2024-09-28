<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\VideoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('category', CategoryController::class)->middleware(['auth', 'verified']);
Route::resource('course', CourseController::class)->middleware(['auth', 'verified']);
Route::resource('video', VideoController::class)->middleware(['auth', 'verified']);


// Route::middleware('auth')->group(function () {
//     Route::get('/category', [CategoryController::class, 'index'])->name('category.get');
//     Route::post('/category', [CategoryController::class, 'store'])->name('category.create');
//     Route::patch('/category', [CategoryController::class, 'update'])->name('category.update');
//     Route::delete('/category', [CategoryController::class, 'destroy'])->name('category.destroy');
// });



// Route::middleware('auth')->group(function () {
//     Route::get('/course', [CourseController::class, 'index'])->name('course.get');
//     Route::post('/course', [CourseController::class, 'store'])->name('course.create');
//     Route::patch('/course', [CourseController::class, 'update'])->name('course.update');
//     Route::delete('/course', [CourseController::class, 'destroy'])->name('course.destroy');
// });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');          // Display the list of videos
// Route::get('/videos/create', [VideoController::class, 'create'])->name('videos.create');  // Show form to create a new video

// Route::post('/videos', [VideoController::class, 'store'])->name('videos.store');         // Store

// Route::get('/videos/{video}', [VideoController::class, 'show'])->name('videos.show');    // Show a single video
// Route::get('/videos/{video}/edit', [VideoController::class, 'edit'])->name('videos.edit');// Show form to edit a video

// Route::put('/videos/{video}', [VideoController::class, 'update'])->name('videos.update');// Update 
// Route::delete('/videos/{video}', [VideoController::class, 'destroy'])->name('videos.destroy'); // Delete

require __DIR__.'/auth.php';
