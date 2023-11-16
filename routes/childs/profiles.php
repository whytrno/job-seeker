<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('profiles')->group(function () {
    Route::get('', [AuthController::class, 'profile']);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::post('', [AuthController::class, 'profileStoreOrUpdate']);
});

?>