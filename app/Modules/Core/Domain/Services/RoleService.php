<?php

namespace App\Modules\Core\Domain\Services;

use App\Modules\Core\Domain\Entities\RoleEntity;
use App\Modules\Core\Domain\Entities\PermissionEntity;
use App\Modules\Core\Application\Models\Role;
use App\Utils\PaginationHelper;

class RoleService
{
    private $roleEntity;
    private $permissionEntity;

    public function __construct(RoleEntity $roleEntity, PermissionEntity $permissionEntity)
    {
        $this->roleEntity = $roleEntity;
        $this->permissionEntity = $permissionEntity;
    }

    public function getAllRoles()
    {
        $rolesQuery = $this->roleEntity->get();
        $roles = [];
        foreach ($rolesQuery as $role) {
            $roles[] = new Role((object)($role->toArray()));
        }
        return $roles;
    }

    public function getRoleByPk($roleId)
    {
        $roleQuery = $this->roleEntity
            ->whereRoleId($roleId)
            ->WithPermissions()
            ->first();
        return new Role((object)($roleQuery->toArray()));
    }

    public function getRoleByParams($params)
    {
        $rolesQuery = $this->roleEntity->newQuery();

        if (isset($params->name)) {
            $rolesQuery->whereNameLike($params->name);
        }

        if (isset($params->created_at)) {
            $rolesQuery->whereCreatedAt($params->created_at);
        }

        if (isset($params->status)) {
            $rolesQuery->whereStatus($params->status);
        }

        $roles = PaginationHelper::paginate($rolesQuery, $params->limit ?? null, new Role);
        return $roles;
    }

    public function addPermission($params)
    {
        $permission = $this->permissionEntity->wherePermissionId($params->permissionId)->first();
        $role = $this->roleEntity->whereRoleId($params->roleId)->AddPermission($permission, $params->status);
        return new Role((object)($role->first()->toArray()));
    }

    public function updatePermission($params)
    {
        $permission = $this->permissionEntity->wherePermissionId($params->permissionId)->first();
        $role = $this->roleEntity->whereRoleId($params->roleId)->UpdatePermission($permission, $params->permissionId);
        return new Role((object)($role->first()->toArray()));
    }
    

    public function createRole(Role $role)
    {
        $roleQuery = $this->roleEntity->newQuery();
        $roleBuild = $roleQuery->createRole($role);
        return new Role((object)($roleBuild->toArray()));
    }

    public function updateRole(Role $role)
    {
        $roleQuery = $this->roleEntity->newQuery();
        $roleQuery->updateRole($role);
        return new Role((object)($roleQuery->first()->toArray()));
    }

}
