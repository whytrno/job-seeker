<?php

use App\Http\Controllers\JobsController;
use Illuminate\Support\Facades\Route;

Route::prefix('jobs')->group(function () {
    Route::get('', [JobsController::class, 'index']);
    Route::get('my', [JobsController::class, 'my']);
    Route::get('{id}', [JobsController::class, 'detail']);
    Route::post('', [JobsController::class, 'store']);
    Route::put('{id}', [JobsController::class, 'update']);
    Route::delete('{id}', [JobsController::class, 'destroy']);
});

?>