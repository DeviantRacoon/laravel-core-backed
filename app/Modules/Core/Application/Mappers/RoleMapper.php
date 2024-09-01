<?php

namespace App\Modules\Core\Application\Mappers;

use App\Modules\Core\Application\Models\Role;
use App\Modules\Core\Application\Models\Permission;

class RoleMapper
{
    public function assignment(Role $role, object $data): void
    {
        if (isset($data->id)) {
            $role->setId($data->id);
        } else {
            $role->setId(null);
        }


        if (isset($data->name)) {
            $role->setName($data->name);
        } else {
            $role->setName(null);
        }


        if (isset($data->description)) {
            $role->setDescription($data->description);
        } else {
            $role->setDescription(null);
        }


        if (isset($data->permissions)) {
            $permissions = $data->permissions;
            array_map(fn($permission) => new Permission((object)$permission), $permissions);
            $role->setPermissions($permissions);
        } else {
            $role->setPermissions(null);
        }

        if (isset($data->status)) {
            $role->setStatus($data->status);
        } else {
            $role->setStatus(null);
        }


        if (isset($data->created_at)) {
            $created_at = new \DateTimeImmutable($data->created_at);
            $role->setCreatedAt($created_at);
        } else {
            $role->setCreatedAt(null);
        }


        if (isset($data->updated_at)) {
            $updated_at = new \DateTimeImmutable($data->updated_at);
            $role->setUpdatedAt($updated_at);
        } else {
            $role->setUpdatedAt(null);
        }
    }


    public function jsonToModel(object $data): Role
    {
        $role = new Role();
        $this->assignment($role, $data);
        return $role;
    }


    public function mapToArray(Role $role): array
    {
        return [
            'id' => $role->getId(),
            'name' => $role->getName(),
            'description' => $role->getDescription(),
            'permissions' => $role->getPermissions(),
            'status' => $role->getStatus(),
            'created_at' => $role->getCreatedAt() ? $role->getCreatedAt()->format('Y-m-d\TH:i:s.uP') : null,
            'updated_at' => $role->getUpdatedAt() ? $role->getUpdatedAt()->format('Y-m-d\TH:i:s.uP') : null,
        ];
    }


    public function mapToArrayMultiple(array $roles): array
    {
        $mapped = [];
        foreach ($roles as $role) {
            $mapped[] = $this->mapToArray($role);
        }
        return $mapped;
    }

}
