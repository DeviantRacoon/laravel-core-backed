<?php

namespace App\Modules\Core\Http\Routes;

use App\Modules\Core\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('', [PermissionController::class, 'getAllPermissions']);
    Route::get('{permissionId}', [PermissionController::class, 'getPermissionByPk'])->where('permissionId', '[0-9]+');
    Route::post('params', [PermissionController::class, 'getPermissionsByParams']);
    Route::post('', [PermissionController::class, 'createPermission']);
    Route::put('', [PermissionController::class, 'updatePermission']);
});

