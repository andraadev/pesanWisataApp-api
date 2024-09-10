<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\destinationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::apiResource('/users', UserController::class);
Route::apiResource('/destination', destinationController::class);
Route::get('/destination', [destinationController::class, 'index']);
Route::post('/destination/add', [destinationController::class, 'store']);
Route::get('/destination/{slug}', [destinationController::class, 'show']);
