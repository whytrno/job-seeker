<?php

namespace App\Http\Controllers;

use App\Http\Traits\ResponseTrait;
use Illuminate\Http\Request;

class MailController extends Controller
{
    use ResponseTrait;

    public function sendMail($email)
    {
        $details = [
            'title' => 'Success',
            'content' => 'This is an email testing using Laravel-Brevo',
        ];

        $send = \Mail::to($email)->send(new \App\Mail\TestMail($details));

        if ($send) {
            return $this->successResponse('Email successfully sent at ' . now());
        } else {
            return $this->failedResponse('Email failed to send', 500);
        }
    }
}
