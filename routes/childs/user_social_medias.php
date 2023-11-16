<?php

use App\Http\Controllers\UserSocialMediasController;
use Illuminate\Support\Facades\Route;

Route::prefix('user-social-medias')->group(function () {
    Route::get('', [UserSocialMediasController::class, 'index']);
    Route::post('', [UserSocialMediasController::class, 'storeOrUpdate']);
});

?>