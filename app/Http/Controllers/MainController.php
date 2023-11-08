<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function test()
    {
        $user = User::with('role', 'jobs', 'jobSeekers.job', 'profile', 'socialMedia')->get();

        return response()->json($user);
    }
}
