<?php

use App\Http\Controllers\ExperienceLevelsController;
use Illuminate\Support\Facades\Route;

Route::prefix('experience-levels')->group(function () {
    Route::get('', [ExperienceLevelsController::class, 'index']);
    Route::get('{id}', [ExperienceLevelsController::class, 'detail']);
    Route::post('', [ExperienceLevelsController::class, 'store']);
    Route::put('{id}', [ExperienceLevelsController::class, 'update']);
    Route::delete('{id}', [ExperienceLevelsController::class, 'destroy']);
});

?>