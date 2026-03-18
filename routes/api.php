<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;



Route::prefix('v1')->name('api.')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    Route::get('/', function () {
        return ['message' => 'Welcome to the API'];
    });

    Route::apiResource('users', \App\Http\Controllers\Api\UserController::class);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    Route::middleware('auth:sanctum')->group(function () {
        // Route::apiResource('posts', \App\Http\Controllers\Api\PostController::class);
        // Route::post('product/purchase/{slug}', [OrderController::class, 'index']);
    });

    // Route::apiResource('products', ProductController::class);
});
