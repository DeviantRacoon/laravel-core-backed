<?php

namespace App\Modules\Core\Application\UseCases;

use App\Modules\Core\Domain\Services\RoleService;

class RoleUseCase
{
    private $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function getAllRoles()
    {
        $roleModels = $this->roleService->getAllRoles();
        return array_map(fn($model) => $model->toArray(), $roleModels);
    }

    public function getRoleByPk($roleId)
    {
        $role = $this->roleService->getRoleByPk($roleId);
        return $role->toArray();
    }

    public function getRolesByParams($params)
    {
        $roleModels = $this->roleService->getRoleByParams($params);
        $roleModels['items'] = array_map(fn($model) => $model->toArray(), $roleModels['items']);
        return $roleModels;
    }

    public function addManyPermission(array $params)
    {
        foreach ($params as $param) {
            $roleModels[] = $this->roleService->addPermission((object)($param));
        }
        return array_map(fn($model) => $model->toArray(), $roleModels);
    }

    public function updateRolPermission(array $params)
    {
        foreach ($params as $param) {
            $roleModels[] = $this->roleService->updatePermission((object)($param));
        }
        return array_map(fn($model) => $model->toArray(), $roleModels);
    }

    public function createRole($params)
    {
        $roleModel = $this->roleService->createRole($params);
        return $roleModel->toArray();
    }

    public function updateRole($params)
    {
        $roleModel = $this->roleService->updateRole($params);
        return $roleModel->toArray();
    }
}
