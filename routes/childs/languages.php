<?php

use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;

Route::prefix('languages')->group(function () {
    Route::get('', [LanguageController::class, 'index']);
    Route::get('{id}', [LanguageController::class, 'detail']);
    Route::post('', [LanguageController::class, 'store']);
    Route::put('{id}', [LanguageController::class, 'update']);
    Route::delete('{id}', [LanguageController::class, 'destroy']);
});

?>