<?php

namespace App\Modules\Core\Application\Models;

use DateTimeImmutable;
use App\Modules\Core\Application\Models\Role;
use App\Modules\Core\Application\Models\Person;
use App\Modules\Core\Application\Mappers\UserMapper;

class User extends UserMapper
{
    public const ACTIVE = 1;
    public const INACTIVE = 2;
    public const PENDING = 3;
    public const DELETED = 99;

    private ?int $id;
    private ?string $name;
    private ?string $email;
    private ?string $password;
    private Role|null $role;
    private Person|null $person;
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

    public function getEmail(): ?string
    { 
        return $this->email;
    }

    public function getPassword(): ?string
    { 
        return $this->password;
    }

    public function getRole(): Role|null
    { 
        return $this->role;
    }

    public function getPerson(): Person|null
    { 
        return $this->person;
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

    public function setEmail(?string $email): void
    { 
        $this->email = $email;
    }

    public function setPassword(?string $password): void
    { 
        $this->password = $password;
    }

    public function setRole(Role|null $role): void
    {
        $this->role = $role;
    }

    public function setPerson(Person|null $person): void
    {
        $this->person = $person;
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

    public function toSave(): array
    {
        return $this->mapToSave($this);
    }

    public function __toString(): string
    {
        return "username: " . $this->name;
    }
}
