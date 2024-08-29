<?php

namespace App\Modules\Core\Domain\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Core\Application\Models\Role;

use App\Modules\Core\Domain\Entities\PermissionEntity;
use App\Modules\Core\Application\Models\Permission;

trait RoleRepository
{

    /* --------------------------------- SELECT --------------------------------- */

    public function getAll(): ?Collection
    {
        return $this->all();
    }


    /* ---------------------------- CREATE OR UPDATE ---------------------------- */

    public function scopeCreateRole($query, Role $role)
    {
        $params = collect($role->toArray())->filter()->all();
        return $query->create($params);
    }

    public function scopeUpdateRole($query, Role $role)
    {
        $params = collect($role->toArray())->filter()->all();
        return $query->where('id', $role->toArray()['id'])->update($params);
    }


    /* -------------------------- RELATIONSHIP METHODS -------------------------- */

    public function scopeWithPermissions($query)
    {
        return $query->with(['permissions' => function ($queryWith) {
            $queryWith->where('mixed_role_permissions.status', Permission::ACTIVE);
        }]);
    }

    public function scopeAddPermission($query, $permission, $status)
    {
        $role = $query->first();
        $existingPermission = $role->permissions()->where('permission', $permission->id)->first();

        if ($existingPermission) {
            $role->permissions()->updateExistingPivot($permission->id, ['status' => $status]);
        } else {
            $role->permissions()->attach($permission->id, ['status' => $status]);
        }

        return $role;
    }


    /* ---------------------------------- WHERE --------------------------------- */

    public function whereEmail(string $email)
    {
        return $this->where('email', $email);
    }

    public function whereRoleId($roleId)
    {
        return $this->where('id', $roleId);
    }

    public function whereStatus($status)
    {
        return $this->where('status', $status);
    }

    public function whereCreatedAt($createdAt)
    {
        return $this->where('created_at', $createdAt);
    }

    public function scopeBetweenCreatedAt($query, $from, $to)
    {
        return $query->whereBetween('created_at', [$from, $to]);
    }

    public function scopeWhereNameLike($query, $name)
    {
        return $query->where('name', 'like', '%' . $name . '%');
    }
}
