<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\SliderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\VideoController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::resource('category', CategoryController::class)->middleware(['auth', 'verified']);
// Route::resource('course/{id?}', CourseController::class)->middleware(['auth', 'verified']);
// Route::resource('video/{id?}', VideoController::class)->middleware(['auth', 'verified']);


Route::middleware('auth')->group(function () {
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::patch('/category/{category}/update', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{category}/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');
});



Route::middleware('auth')->group(function () {
    Route::get('/course', [CourseController::class, 'index'])->name('course.index');
    Route::get('/course/create', [CourseController::class, 'create'])->name('course.create');
    Route::post('/course/store', [CourseController::class, 'store'])->name('course.store');
    Route::get('/course/{course}/edit', [CourseController::class, 'edit'])->name('course.edit');
    Route::patch('/course/{course}/update', [CourseController::class, 'update'])->name('course.update');
    Route::delete('/course/{course}/destroy', [CourseController::class, 'destroy'])->name('course.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');          // Display the list of videos
Route::get('/videos/create', [VideoController::class, 'create'])->name('videos.create');  // Show form to create a new video
Route::post('/videos/store', [VideoController::class, 'store'])->name('videos.store');         // Store
Route::get('/videos/{video}', [VideoController::class, 'show'])->name('videos.show');    // Show a single video
Route::get('/videos/{video}/edit', [VideoController::class, 'edit'])->name('videos.edit'); // Show form to edit a video
Route::put('/videos/{video}/update', [VideoController::class, 'update'])->name('videos.update'); // Update 
Route::delete('/videos/{video}/destroy', [VideoController::class, 'destroy'])->name('videos.destroy'); // Delete

Route::middleware('auth')->group(function () {
    Route::get('/slider', [SliderController::class, 'index'])->name('slider.index');
    Route::get('/slider/create', [SliderController::class, 'create'])->name('slider.create');
    Route::post('/slider/store', [SliderController::class, 'store'])->name('slider.store');
    Route::get('/slider/{slider}/edit', [SliderController::class, 'edit'])->name('slider.edit');
    Route::patch('/slider/{slider}/update', [SliderController::class, 'update'])->name('slider.update');
    Route::delete('/slider/{slider}/destroy', [SliderController::class, 'destroy'])->name('slider.destroy');
});

require __DIR__ . '/auth.php';
