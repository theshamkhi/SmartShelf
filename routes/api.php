<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RayonController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::apiResource('rayons', RayonController::class);

Route::get('/products/search', [ProductController::class, 'search']);
// apiResource Under Search to avoid conflicts
Route::apiResource('products', ProductController::class);

Route::get('/rayons/{rayonId}/products', [ProductController::class, 'getProductsInRayon']);

Route::get('/getStats', [OrderController::class, 'getStats']);
Route::get('/getAlert', [ProductController::class, 'getAlert']);