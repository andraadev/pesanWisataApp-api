<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
// Route::get('/user', [UserController::class, 'index'])->name('index');
// Route::post('/user/store', [UserController::class, 'store'])->name('store');
// Route::post('/user/upd', [UserController::class, 'store'])->name('store');
Route::apiResource('/users', UserController::class);
