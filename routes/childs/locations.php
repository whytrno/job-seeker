<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobLocationsController;
use Illuminate\Support\Facades\Route;

Route::prefix('locations')->group(function () {
    Route::get('', [JobLocationsController::class, 'index']);
    Route::get('{id}', [JobLocationsController::class, 'detail']);
    Route::post('', [JobLocationsController::class, 'store']);
    Route::put('{id}', [JobLocationsController::class, 'update']);
    Route::delete('{id}', [JobLocationsController::class, 'destroy']);
});

?>