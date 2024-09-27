<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\CategoryController;

use App\Http\Controllers\Api\UserController;



// Public API 
Route::get('/sliders', [SliderController::class, 'index']); 
Route::get('/categories', [CategoryController::class, 'index']); 
Route::get('/top-categories', [CategoryController::class, 'TopCategories']); 



// Auth api
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/send-otp', [AuthController::class, 'sendOtp']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
Route::put('/update-profile', [UserController::class, 'updateProfile'])->middleware('auth:sanctum'); 