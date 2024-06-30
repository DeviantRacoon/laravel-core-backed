<?php

namespace App\Modules\Core\Http\Routes;

use App\Modules\Core\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('', [RoleController::class, 'getAllRoles']);
    Route::get('{roleId}', [RoleController::class, 'getRoleByPk'])->where('roleId', '[0-9]+');
    Route::post('permission', [RoleController::class, 'addManyPermission']);
    Route::put('permission', [RoleController::class, 'addManyPermission']);
    Route::post('', [RoleController::class, 'createRole']);
    Route::put('', [RoleController::class, 'updateRole']);
});
