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
    private ?string $remember_token;
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
        $this->remember_token = $data->remember_token ?? null;
        $this->role = is_object($data->role) ? new Role((object)$data->role) ?? null : $data->role;
        $this->status = $data->status ?? null;
        $this->created_at = $data->created_at ? new DateTimeImmutable($data->created_at) : null;
        $this->updated_at = $data->updated_at ? new DateTimeImmutable($data->updated_at) : null;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }


    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }


    public function getRememberToken(): ?string
    {
        return $this->remember_token;
    }

    public function setRememberToken(?string $remember_token): void
    {
        $this->remember_token = $remember_token;
    }


    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): void
    {
        $this->role = $role;
    }

    
    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): void
    {
        $this->status = $status;
    }


    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(?DateTimeImmutable $created_at): void
    {
        $this->created_at = $created_at;
    }


    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?DateTimeImmutable $updated_at): void
    {
        $this->updated_at = $updated_at;
    }


    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'remember_token' => $this->remember_token,
            'role' => is_object($this->role) ? $this->role->toArray() : $this->role,
            'status' => $this->status,
            'created_at' => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : null,
            'updated_at' => $this->updated_at ? $this->updated_at->format('Y-m-d H:i:s') : null,
        ];
    }

    public function __toString(): string
    {
        return "username: " . $this->name;
    }
}
