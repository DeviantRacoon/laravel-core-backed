<?php

namespace App\Modules\Core\Domain\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Core\Application\Models\Permission;

trait PermissionRepository
{

    /* --------------------------------- SELECT --------------------------------- */

    public function getAll(): ?Collection
    {
        return $this->all();
    }


    /* ---------------------------- CREATE OR UPDATE ---------------------------- */

    public function scopeCreatePermission($query, Permission $permission)
    {
        $params = collect($permission->toArray())->filter()->all();
        return $query->create($params);
    }

    public function scopeUpdatePermission($query, Permission $permission)
    {
        $params = collect($permission->toArray())->filter()->all();
        return $query->where('id', $permission->getId())->update($params);
    }
    

    /* ---------------------------------- WHERE --------------------------------- */

    public function whereEmail(string $email)
    {
        return $this->where('email', $email);
    }

    public function wherePermissionId($permissionId)
    {
        return $this->where('id', $permissionId);
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
