<?php

namespace App\Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Core\Application\Models\Permission;
use App\Modules\Core\Application\UseCases\PermissionUseCase;
use App\Modules\Core\Http\Validators\PermissionValidator\CreatePermissionRequest;
use App\Modules\Core\Http\Validators\PermissionValidator\UpdatePermissionRequest;

class PermissionController
{
    private $permissionUseCase;

    public function __construct(PermissionUseCase $permissionUseCase)
    {
        $this->permissionUseCase = $permissionUseCase;
    }

    public function getAllPermissions()
    {
        try {
            $permission = $this->permissionUseCase->getAllPermissions();

            return response()->json([
                'ok' => true,
                'data' => $permission,
                'message' => "Se obtuvieron los permisos correctamente",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'ok' => false,
                'data' => null,
                'errors' => [$th->getMessage()],
            ]);
        }
    }

    public function getPermissionByPk($permissionId)
    {
        try {
            $permission = $this->permissionUseCase->getPermissionByPk($permissionId);

            return response()->json([
                'ok' => true,
                'data' => $permission,
                'message' => "Se obtuvo el permiso correctamente",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'ok' => false,
                'data' => null,
                'errors' => [$th->getMessage()],
            ]);
        }
    }

    public function getPermissionByParams(Request $request)
    {
        try {
            $permission = $this->permissionUseCase->getPermissionByParams((object)$request->all());

            return response()->json([
                'ok' => true,
                'data' => $permission,
                'message' => "Se obtuvieron los permisos correctamente",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'ok' => false,
                'data' => null,
                'errors' => [$th->getMessage()],
            ]);
        }
    }

    public function createPermission(CreatePermissionRequest $request)
    {
        try {
            $permission = new permission($request);
            $permission = $this->permissionUseCase->createPermission($permission);

            return response()->json([
                'ok' => true,
                'data' => $permission,
                'message' => "Se creo el permiso correctamente",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'ok' => false,
                'data' => null,
                'errors' => [$th->getMessage()],
            ]);
        }
    }

    public function updatePermission(UpdatePermissionRequest $request)
    {
        try {
            $permission = new permission($request);
            $permission = $this->permissionUseCase->updatePermission($permission);

            return response()->json([
                'ok' => true,
                'data' => $permission,
                'message' => "Se actualizo el permiso correctamente",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'ok' => false,
                'data' => null,
                'errors' => [$th->getMessage()],
            ]);
        }
    }

}
