<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware('roleAccess:1')->group(function () {
        require_once "childs/categories.php";
        require_once "childs/locations.php";
        require_once "childs/contract_types.php";
        require_once "childs/experience_levels.php";
        require_once "childs/industries.php";
        require_once "childs/minimum_educations.php";
        require_once "childs/salary_ranges.php";
        require_once "childs/languages.php";
    });

    Route::middleware('roleAccess:1,2')->group(function () {
        require_once "childs/jobs.php";
    });

    Route::middleware('roleAccess:1,2,3')->group(function () {
        require_once "childs/user_jobs.php";
        require_once "childs/user_social_medias.php";
    });

    Route::middleware('roleAccess:2,3')->group(function () {
        require_once "childs/profiles.php";
    });
});

require_once "childs/auth.php";