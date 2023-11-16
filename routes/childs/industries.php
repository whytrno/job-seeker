<?php

use App\Http\Controllers\IndustriesController;
use Illuminate\Support\Facades\Route;

Route::prefix('industries')->group(function () {
    Route::get('', [IndustriesController::class, 'index']);
    Route::get('{id}', [IndustriesController::class, 'detail']);
    Route::post('', [IndustriesController::class, 'store']);
    Route::put('{id}', [IndustriesController::class, 'update']);
    Route::delete('{id}', [IndustriesController::class, 'destroy']);
});

?>