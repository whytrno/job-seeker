<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('profiles')->group(function () {
    Route::get('', [AuthController::class, 'profile']);
    Route::post('', [AuthController::class, 'profileStoreOrUpdate']);
});

?>