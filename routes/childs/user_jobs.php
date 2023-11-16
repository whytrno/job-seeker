<?php

use App\Http\Controllers\UserJobsController;
use Illuminate\Support\Facades\Route;

Route::prefix('user-jobs')->group(function () {
    Route::get('', [UserJobsController::class, 'index']);
    Route::post('', [UserJobsController::class, 'store']);
    Route::put('{id}', [UserJobsController::class, 'update']);
    Route::delete('{id}', [UserJobsController::class, 'destroy']);
});

?>