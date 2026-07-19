<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;

use App\Http\Controllers\Api\ProductController;

Route::name('api.')->group(function () {
    Route::apiResource('tasks', TaskController::class);
});



Route::prefix('products')->group(function () {

    Route::get('/', [ProductController::class, 'index']);
    Route::post('/', [ProductController::class, 'store']);
    Route::put('/{product}', [ProductController::class, 'update']);
    Route::delete('/{product}', [ProductController::class, 'destroy']);

});