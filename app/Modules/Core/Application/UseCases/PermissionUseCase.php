<?php

namespace App\Modules\Core\Application\UseCases;

use App\Modules\Core\Domain\Services\PermissionService;

class PermissionUseCase
{
    private $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function getAllPermissions()
    {
        $permissionModel = $this->permissionService->getAllPermissions();
        return array_map(fn($model) => $model->toArray(), $permissionModel);
    }

    public function getPermissionByPk($permissionId)
    {
        $permission = $this->permissionService->getPermissionByPk($permissionId);
        return $permission->toArray();
    }

    public function getPermissionByParams($params)
    {
        $permissionModel = $this->permissionService->getPermissionByParams($params);
        return array_map(fn($model) => $model->toArray(), $permissionModel);
    }

    public function createPermission($params)
    {
        $permissionModel = $this->permissionService->createPermission($params);
        return $permissionModel->toArray();
    }

    public function updatePermission($params)
    {
        $permissionModel = $this->permissionService->updatePermission($params);
        return $permissionModel->toArray();
    }
}
