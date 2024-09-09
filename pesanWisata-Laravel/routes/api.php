<?php

use App\Http\Controllers\destinationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::apiResource('/destination', destinationController::class);
Route::get('/destination/{slug}', [destinationController::class, 'show']);