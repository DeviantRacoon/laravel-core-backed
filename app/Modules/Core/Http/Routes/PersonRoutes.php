<?php

namespace App\Modules\Core\Http\Routes;

use App\Modules\Core\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('', [PersonController::class, 'getAllPersons']);
    Route::get('{personId}', [PersonController::class, 'getPersonByPk'])->where('personId', '[0-9]+');
    Route::post('params', [PersonController::class, 'getPersonsByParams']);
    Route::post('', [PersonController::class, 'createPerson']);
    Route::put('', [PersonController::class, 'updatePerson']);
});
