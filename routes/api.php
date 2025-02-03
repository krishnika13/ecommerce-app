<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

use App\Http\Controllers\ProductController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('products', ProductController::class);
});

use App\Http\Controllers\Auth\OrderController; 



Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('orders', OrderController::class);      // Protect all order routes
    Route::apiResource('products', ProductController::class);    // Protect all product routes

 
});

// ... any other routes