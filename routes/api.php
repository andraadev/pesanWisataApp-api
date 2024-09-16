<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\destinationController;
use App\Http\Controllers\BookingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::apiResource('/users', UserController::class);
Route::apiResource('/destinations', destinationController::class);
Route::get('/destination/{slug}', [destinationController::class, 'show']);
Route::apiResource('/booking', BookingController::class);
