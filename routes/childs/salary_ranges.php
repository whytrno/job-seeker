<?php

use App\Http\Controllers\SalaryRangesController;
use Illuminate\Support\Facades\Route;

Route::prefix('salary-ranges')->group(function () {
    Route::get('', [SalaryRangesController::class, 'index']);
    Route::get('{id}', [SalaryRangesController::class, 'detail']);
    Route::post('', [SalaryRangesController::class, 'store']);
    Route::put('{id}', [SalaryRangesController::class, 'update']);
    Route::delete('{id}', [SalaryRangesController::class, 'destroy']);
});

?>