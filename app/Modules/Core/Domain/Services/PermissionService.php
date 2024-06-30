<?php

namespace App\Modules\Core\Domain\Services;

use App\Modules\Core\Domain\Entities\PermissionEntity;
use App\Modules\Core\Application\Models\Permission;

class PermissionService
{
    private $permissionEntity;

    public function __construct(PermissionEntity $permissionEntity)
    {
        $this->permissionEntity = $permissionEntity;
    }

    public function getAllPermissions()
    {
        $permissionsQuery = $this->permissionEntity->get();
        $permissions = [];
        foreach ($permissionsQuery as $permission) {
            $permissions[] = new Permission((object)($permission->toArray()));
        }
        return $permissions;
    }

    public function getPermissionByPk($permissionId)
    {
        $permissionQuery = $this->permissionEntity
            ->wherePermissionId($permissionId)
            ->first();

        return new Permission((object)($permissionQuery->toArray()));
    }

    public function getPermissionByParams($params)
    {
        $permissionsQuery = $this->permissionEntity->newQuery();

        if (isset($params->name)) {
            $permissionsQuery->whereNameLike($params->name);
        }

        if (isset($params->email)) {
            $permissionsQuery->whereEmail($params->email);
        }

        if (isset($params->created_at)) {
            $permissionsQuery->whereCreatedAt($params->created_at);
        }

        if (isset($params->status)) {
            $permissionsQuery->whereStatus($params->status);
        }

        $permissions = [];
        foreach ($permissionsQuery->get() as $permission) {
            $permissions[] = new Permission((object)($permission->toArray()));
        }

        return $permissions;
    }

    public function createPermission(Permission $permission)
    {
        $permissionQuery = $this->permissionEntity->newQuery();
        $permissionBuild = $permissionQuery->createPermission($permission);
        return new Permission((object)($permissionBuild->toArray()));
    }

    public function updatePermission(Permission $permission)
    {
        $permissionQuery = $this->permissionEntity->newQuery();
        $permissionQuery->updatePermission($permission);
        return new Permission((object)($permissionQuery->first()->toArray()));
    }

}
