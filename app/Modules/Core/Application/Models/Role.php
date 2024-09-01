<?php

namespace App\Modules\Core\Application\Models;

use \DateTimeImmutable;
use App\Modules\Core\Application\Models\Permission;
use App\Modules\Core\Application\Mappers\RoleMapper;

class Role extends RoleMapper
{
    public const ACTIVE   = 1;
    public const INACTIVE = 2;
    public const PENDING  = 3;
    public const DELETED  = 99;

    private ?int $id;
    private ?string $name;
    private ?string $description;
    private mixed $permissions;
    private ?int $status;
    private ?DateTimeImmutable $created_at;
    private ?DateTimeImmutable $updated_at;

    public function __construct(object $data = null)
    {
        if ($data) $this->assignment($this, $data); 
    }


    /* --------------------------------- GETTER --------------------------------- */

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPermissions(): mixed
    {
        return $this->permissions;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updated_at;
    }


    /* --------------------------------- SETTER --------------------------------- */

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function setPermissions(mixed $permissions): void
    {
        $this->permissions = $permissions;
    }

    public function setStatus(?int $status): void
    {
        $this->status = $status;
    }

    public function setCreatedAt(?DateTimeImmutable $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function setUpdatedAt(?DateTimeImmutable $updated_at): void
    {
        $this->updated_at = $updated_at;
    }


    /* --------------------------------- OTHERS --------------------------------- */

    public function toArray(): array
    {
        return $this->mapToArray($this);
    }  

    public function __toString(): string
    {
        return (string)$this->id;
    }
}
