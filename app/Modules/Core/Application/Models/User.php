<?php

namespace App\Modules\Core\Application\Models;

use \DateTimeImmutable;
use App\Modules\Core\Application\Models\Role;

class User
{
    public const ACTIVE   = 1;
    public const INACTIVE = 2;
    public const PENDING  = 3;
    public const DELETED  = 99;

    private ?int $id;
    private ?string $name;
    private ?string $email;
    private ?string $password;
    private mixed $role;
    private ?int $status;
    private ?DateTimeImmutable $created_at;
    private ?DateTimeImmutable $updated_at;

    public function __construct($data)
    {
        $this->id = $data->id ?? null;
        $this->name = $data->name ?? null;
        $this->email = $data->email ?? null;
        $this->password = $data->password ?? null;
        $this->role = is_object($data->role) ? new Role((object)$data->role) ?? null : $data->role;
        $this->status = $data->status ?? null;
        $this->created_at = $data->created_at ? new DateTimeImmutable($data->created_at) : null;
        $this->updated_at = $data->updated_at ? new DateTimeImmutable($data->updated_at) : null;
    }

    public function toArray(): object
    {
        return (object)[
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'role' => is_object($this->role) ? $this->role->toArray() : $this->role,
            'status' => $this->status,
            'created_at' => $this->created_at ? $this->created_at->format('Y-m-d\TH:i:s.uP') : null,
            'updated_at' => $this->updated_at ? $this->updated_at->format('Y-m-d\TH:i:s.uP') : null,
        ];
    }

    public function __toString(): string
    {
        return "username: " . $this->name;
    }
}
