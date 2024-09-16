<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\destinationController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('admin/users', UserController::class);
    Route::apiResource('admin/destinations', destinationController::class);
    Route::get('admin/destination/{slug}', [destinationController::class, 'show']);
    Route::apiResource('admin/booking', BookingController::class);
});
