<?php

namespace App\Modules\Core\Application\Models;

use \DateTimeImmutable;
use App\Modules\Core\Application\Models\PersonAdditionalData;
use App\Modules\Core\Application\Mappers\PersonMapper;

class Person extends PersonMapper
{
    public const ACTIVE = 1;
    public const INACTIVE = 2;
    public const PENDING = 3;
    public const DELETED = 99;

    private ?int $id;
    private ?string $firstName;
    private ?string $middleName;
    private ?string $lastName;
    private ?string $secondLastName;
    private ?string $gender;
    private ?string $birthDate;
    private mixed $additionalData;
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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getSecondLastName(): ?string
    {
        return $this->secondLastName;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function getBirthDate(): ?string
    {
        return $this->birthDate;
    }

    public function getAdditionalData(): mixed
    {
        return $this->additionalData;
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

    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function setMiddleName(?string $middleName): void
    {
        $this->middleName = $middleName;
    }

    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function setSecondLastName(?string $secondLastName): void
    {
        $this->secondLastName = $secondLastName;
    }

    public function setGender(?string $gender): void
    {
        $this->gender = $gender;
    }

    public function setBirthDate(?string $birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    public function setAdditionalData(mixed $additionalData): void
    {
        $this->additionalData = $additionalData;
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

    
    /* ---------------------------------- OTHER --------------------------------- */

    public function toArray(): array
    {
        return $this->mapToArray($this);
    }  

    public function __toString(): string
    {
        return (string) $this->id;
    }
}
