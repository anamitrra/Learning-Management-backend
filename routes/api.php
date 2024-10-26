<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\HomeScreenController;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VideoController;


// Public API 
Route::get('/sliders', [SliderController::class, 'index']); 
Route::get('/categories', [CategoryController::class, 'index']); 
Route::get('/top-categories', [CategoryController::class, 'TopCategories']); 
Route::get('/home', [HomeScreenController::class, 'homeScreenData']);


//video APi




Route::get('/videos/free', [VideoController::class, 'getFreeVideos'])->name('api.videos.free');
Route::get('/videos', [VideoController::class, 'getAllVideos'])->name('api.videos.all');
Route::get('/videos/{id}/play', [VideoController::class, 'playVideo'])->name('api.videos.play');


// Auth api
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/send-otp', [AuthController::class, 'sendOtp']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
Route::put('/update-profile', [UserController::class, 'updateProfile'])->middleware('auth:sanctum'); 