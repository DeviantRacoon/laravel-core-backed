<?php

namespace App\Modules\Core\Application\Mappers;

use App\Modules\Core\Application\Models\Permission;

class PermissionMapper
{
    public function assignment(Permission $permission, $data): void
    {
        if (isset($data->id)) {
            $permission->setId($data->id);
        } else {
            $permission->setId(null);
        }


        if (isset($data->name)) {
            $permission->setName($data->name);
        } else {
            $permission->setName(null);
        }


        if (isset($data->description)) {
            $permission->setDescription($data->description);
        } else {
            $permission->setDescription(null);
        }


        if (isset($data->status)) {
            $permission->setStatus($data->status);
        } else {
            $permission->setStatus(null);
        }


        if (isset($data->created_at)) {
            $created_at = new \DateTimeImmutable($data->created_at);
            $permission->setCreatedAt($created_at);
        } else {
            $permission->setCreatedAt(null);
        }


        if (isset($data->updated_at)) {
            $updated_at = new \DateTimeImmutable($data->updated_at);
            $permission->setUpdatedAt($updated_at);
        } else {
            $permission->setUpdatedAt(null);
        }

    }


    public function jsonToModel(object $data): Permission
    {
        $permission = new Permission();
        $this->assignment($permission, $data);
        return $permission;
    }


    public function mapToArray(Permission $permission): array
    {
        return [
            'id' => $permission->getId(),
            'name' => $permission->getName(),
            'description' => $permission->getDescription(),
            'status' => $permission->getStatus(),
            'created_at' => $permission->getCreatedAt() ? $permission->getCreatedAt()->format('Y-m-d\TH:i:s.uP') : null,
            'updated_at' => $permission->getUpdatedAt() ? $permission->getUpdatedAt()->format('Y-m-d\TH:i:s.uP') : null,
        ];
    }


    public function mapToArrayMultiple($permissions): array
    {
        dd($permissions);
        $mapped = [];
        foreach ($permissions as $permission) {
            $mapped[] = $this->mapToArray($permission);
        }
        return $mapped;
    }

}
