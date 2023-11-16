<?php

use App\Http\Controllers\ContractTypesController;
use Illuminate\Support\Facades\Route;

Route::prefix('contract-types')->group(function () {
    Route::get('', [ContractTypesController::class, 'index']);
    Route::get('{id}', [ContractTypesController::class, 'detail']);
    Route::post('', [ContractTypesController::class, 'store']);
    Route::put('{id}', [ContractTypesController::class, 'update']);
    Route::delete('{id}', [ContractTypesController::class, 'destroy']);
});

?>