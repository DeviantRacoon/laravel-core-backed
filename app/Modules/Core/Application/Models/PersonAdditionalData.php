<?php

namespace App\Modules\Core\Application\Models;
use \DateTimeImmutable;
use App\Modules\Core\Application\Mappers\PersonAdditionalDataMapper;

class PersonAdditionalData extends PersonAdditionalDataMapper
{
    public const ACTIVE   = 1;
    public const INACTIVE = 2;
    public const PENDING  = 3;
    public const DELETED  = 99;

    private ?int $id;
    private ?string $curp;
    private ?string $cellphone;
    private ?string $photo;
    private mixed $addresses;
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

    public function getCurp(): ?string
    {
        return $this->curp;
    }

    public function getCellphone(): ?string
    {
        return $this->cellphone;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function getAddresses(): mixed
    {
        return $this->addresses;
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

    public function setCurp(?string $curp): void
    {
        $this->curp = $curp;
    }

    public function setCellphone(?string $cellphone): void
    {
        $this->cellphone = $cellphone;
    }

    public function setPhoto(?string $photo): void
    {
        $this->photo = $photo;
    }

    public function setAddresses(mixed $addresses): void
    {
        $this->addresses = $addresses;
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

    public function arrayAddresses(): array
    {
        return $this->mapToArrayAddresses($this);
    }

    public function __toString(): string
    {
        return (string) $this->id;
    }
}


