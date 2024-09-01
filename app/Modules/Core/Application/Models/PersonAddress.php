<?php

namespace App\Modules\Core\Application\Models;
use \DateTimeImmutable;
use App\Modules\Core\Application\Mappers\PersonAddressMapper;

class PersonAddress extends PersonAddressMapper
{
    public const ACTIVE   = 1;
    public const INACTIVE = 2;
    public const PENDING  = 3;
    public const DELETED  = 99;

    private ?int $id;
    private ?string $street;
    private ?string $exteriorNumber;
    private ?string $interiorNumber;
    private ?string $neighborhood;
    private ?string $addressReference;
    private ?string $municipality;
    private ?string $state;
    private ?string $country;
    private ?string $postalCode;
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

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function getExteriorNumber(): ?string
    {
        return $this->exteriorNumber;
    }

    public function getInteriorNumber(): ?string
    {
        return $this->interiorNumber;
    }

    public function getNeighborhood(): ?string
    {
        return $this->neighborhood;
    }

    public function getAddressReference(): ?string
    {
        return $this->addressReference;
    }

    public function getMunicipality(): ?string
    {
        return $this->municipality;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
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

    public function setStreet(?string $street): void
    {
        $this->street = $street;
    }

    public function setExteriorNumber(?string $exteriorNumber): void
    {
        $this->exteriorNumber = $exteriorNumber;
    }

    public function setInteriorNumber(?string $interiorNumber): void
    {
        $this->interiorNumber = $interiorNumber;
    }

    public function setNeighborhood(?string $neighborhood): void
    {
        $this->neighborhood = $neighborhood;
    }

    public function setAddressReference(?string $addressReference): void
    {
        $this->addressReference = $addressReference;
    }

    public function setMunicipality(?string $municipality): void
    {
        $this->municipality = $municipality;
    }

    public function setState(?string $state): void
    {
        $this->state = $state;
    }

    public function setCountry(?string $country): void
    {
        $this->country = $country;
    }

    public function setPostalCode(?string $postalCode): void
    {
        $this->postalCode = $postalCode;
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


    public function toArray(): array
    {
        return $this->mapToArray($this);
    }  

    public function __toString(): string
    {
        return (string) $this->id;
    }
}

