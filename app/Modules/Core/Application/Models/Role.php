<?php

namespace App\Modules\Core\Application\Models;

use \DateTimeImmutable;
use App\Modules\Core\Application\Models\Permission;

class Role
{
    public const ACTIVE   = 1;
    public const INACTIVE = 2;
    public const PENDING  = 3;
    public const DELETED  = 99;

    private ?int $id;
    private ?string $name;
    private ?string $description;
    private ?array $permissions;
    private ?int $status;
    private ?DateTimeImmutable $created_at;
    private ?DateTimeImmutable $updated_at;

    public function __construct($data)
    {
        $this->id = $data->id ?? null;
        $this->name = $data->name ?? null;
        $this->description = $data->description ?? null;
        $this->permissions = isset($data->permissions) ? array_map(fn ($permission) => new Permission((object)($permission)), $data->permissions) : [];
        $this->status = $data->status ?? null;
        $this->created_at = isset($data->created_at) ? new DateTimeImmutable($data->created_at) : null;
        $this->updated_at = isset($data->updated_at) ? new DateTimeImmutable($data->updated_at) : null;
    }

    public function toArray(): object
    {
        return (object)[
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'permissions' => $this->permissions ? array_map(fn ($permission) => $permission->toArray(), $this->permissions) : [],
            'status' => $this->status,
            'created_at' => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : null,
            'updated_at' => $this->updated_at ? $this->updated_at->format('Y-m-d H:i:s') : null,
        ];
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
