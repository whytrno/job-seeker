<?php

use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;

Route::prefix('send-email')->group(function () {
    // Route::get('', function () {
    //     $details = [
    //         'title' => 'Success',
    //         'content' => 'This is an email testing using Laravel-Brevo',
    //     ];

    //     \Mail::to('whytrno@gmail.com')->send(new \App\Mail\TestMail($details));

    //     return 'Email sent at ' . now();
    // });
    Route::get('{email}', [MailController::class, 'sendMail']);
});

?>