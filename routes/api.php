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

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('rayons', RayonController::class)->middleware(['role:admin']);

    Route::get('/products/search', [ProductController::class, 'search'])->middleware(['role:client']);
    // apiResource Under Search to avoid conflicts
    Route::apiResource('products', ProductController::class);
    
    Route::get('/rayons/{rayonId}/products', [ProductController::class, 'getProductsInRayon'])->middleware(['role:client']);
    
    Route::get('/getStats', [OrderController::class, 'getStats'])->middleware(['role:admin']);
    Route::get('/getAlert', [ProductController::class, 'getAlert'])->middleware(['role:admin']);

    Route::post('/logout', [AuthController::class, 'logout']);
});