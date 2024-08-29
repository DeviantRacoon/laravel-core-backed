<?php

use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(base_path('app/Modules/Core/Http/Routes/UserRoutes.php'));
Route::prefix('role')->group(base_path('app/Modules/Core/Http/Routes/RoleRoutes.php'));
Route::prefix('permission')->group(base_path('app/Modules/Core/Http/Routes/PermissionRoutes.php'));
Route::prefix('person')->group(base_path('app/Modules/Core/Http/Routes/PersonRoutes.php'));