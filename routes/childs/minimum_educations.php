<?php

use App\Http\Controllers\MinimumEducationsController;
use Illuminate\Support\Facades\Route;

Route::prefix('minimum-educations')->group(function () {
    Route::get('', [MinimumEducationsController::class, 'index']);
    Route::get('{id}', [MinimumEducationsController::class, 'detail']);
    Route::post('', [MinimumEducationsController::class, 'store']);
    Route::put('{id}', [MinimumEducationsController::class, 'update']);
    Route::delete('{id}', [MinimumEducationsController::class, 'destroy']);
});

?>