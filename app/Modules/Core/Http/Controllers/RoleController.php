<?php

namespace App\Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Core\Application\Models\Role;
use App\Modules\Core\Application\UseCases\RoleUseCase;

use App\Modules\Core\Http\Validators\RoleValidator\CreateRoleRequest;
use App\Modules\Core\Http\Validators\RoleValidator\UpdateRoleRequest;
use App\Modules\Core\Http\Validators\RoleValidator\AddPermissionRoleRequest;

class RoleController
{
    private $roleUseCase;

    public function __construct(roleUseCase $roleUseCase)
    {
        $this->roleUseCase = $roleUseCase;
    }

    public function getAllRoles()
    {
        try {
            $roles = $this->roleUseCase->getAllRoles();

            return response()->json([
                'ok' => true,
                'data' => $roles,
                'message' => "Se obtuvieron los roles correctamente",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'ok' => false,
                'data' => null,
                'errors' => [$th->getMessage()],
            ]);
        }
    }

    public function getRoleByPk($roleId)
    {
        try {
            $role = $this->roleUseCase->getRoleByPk($roleId);

            return response()->json([
                'ok' => true,
                'data' => $role,
                'message' => "Se obtuvo el rol correctamente",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'ok' => false,
                'data' => null,
                'errors' => [$th->getMessage()],
            ]);
        }
    }

    public function getRolesByParams(Request $request)
    {
        try {
            $roles = $this->roleUseCase->getRolesByParams((object)$request->all());

            return response()->json([
                'ok' => true,
                'data' => $roles,
                'message' => "Se obtuvieron los roles correctamente",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'ok' => false,
                'data' => null,
                'errors' => [$th->getMessage()],
            ]);
        }
    }

    public function addManyPermission(AddPermissionRoleRequest $request)
    {
        try {
            $roles = $this->roleUseCase->addManyPermission($request->all());
            return response()->json([
                'ok' => true,
                'data' => $roles,
                'message' => "Se han actualizado los permisos correctamente",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'ok' => false,
                'data' => null,
                'errors' => [$th->getMessage()],
            ]);
        }
    }

    public function createRole(CreateRoleRequest $request)
    {
        try {
            $role = new role($request);
            $roles = $this->roleUseCase->createRole($role);

            return response()->json([
                'ok' => true,
                'data' => $roles,
                'message' => "Se creo el rol correctamente",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'ok' => false,
                'data' => null,
                'errors' => [$th->getMessage()],
            ]);
        }
    }

    public function updateRole(UpdateRoleRequest $request)
    {
        try {
            $role = new role($request);
            $roles = $this->roleUseCase->updateRole($role);

            return response()->json([
                'ok' => true,
                'data' => $roles,
                'message' => "Se actualizo el rol correctamente",
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
