<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobCategoriesController;
use Illuminate\Support\Facades\Route;

Route::prefix('categories')->group(function () {
    Route::get('', [JobCategoriesController::class, 'index']);
    Route::get('{id}', [JobCategoriesController::class, 'detail']);
    Route::post('', [JobCategoriesController::class, 'store']);
    Route::put('{id}', [JobCategoriesController::class, 'update']);
    Route::delete('{id}', [JobCategoriesController::class, 'destroy']);
});

?>