<?php

namespace App\Modules\Core\Domain\Services;

use App\Modules\Core\Domain\Entities\RoleEntity;
use App\Modules\Core\Application\Models\Role;

class RoleService
{
    private $roleEntity;

    public function __construct(RoleEntity $roleEntity)
    {
        $this->roleEntity = $roleEntity;
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
            ->first();

        return new role((object)($roleQuery->toArray()));
    }

    public function getRoleByParams($params)
    {
        $rolesQuery = $this->roleEntity->newQuery();

        if (isset($params->name)) {
            $rolesQuery->whereNameLike($params->name);
        }

        if (isset($params->email)) {
            $rolesQuery->whereEmail($params->email);
        }

        if (isset($params->created_at)) {
            $rolesQuery->whereCreatedAt($params->created_at);
        }

        if (isset($params->status)) {
            $rolesQuery->whereStatus($params->status);
        }

        $Roles = [];
        foreach ($rolesQuery->get() as $role) {
            $Roles[] = new role((object)($role->toArray()));
        }

        return $Roles;
    }

    public function createRole(role $role)
    {
        $roleQuery = $this->roleEntity->newQuery();
        $roleBuild = $roleQuery->createRole($role);
        return new role((object)($roleBuild->toArray()));
    }

    public function updateRole(role $role)
    {
        $roleQuery = $this->roleEntity->newQuery();
        $roleQuery->updateRole($role);
        return new role((object)($roleQuery->first()->toArray()));
    }

}
