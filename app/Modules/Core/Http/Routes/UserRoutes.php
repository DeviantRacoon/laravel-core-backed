<?php

namespace App\Modules\Core\Http\Routes;

use App\Modules\Core\Http\Controllers\AuthController;
use App\Modules\Core\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', AuthController::class . '@login');
Route::post('/logout', AuthController::class . '@logout');
Route::post('/register', AuthController::class . '@register');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('', [UserController::class, 'getAllUsers']);
    Route::get('{userId}', [UserController::class, 'getUserByPk'])->where('userId', '[0-9]+');
    Route::post('params', [UserController::class, 'getUserByParams']);
    Route::put('', [UserController::class, 'updateUser']);
});

