<?php

namespace App\Modules\Core\Application\Models;
use \DateTimeImmutable;

class PersonAddress
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

    public function __construct($data)
    {
        $this->id = $data->id ?? null;
        $this->street = $data->street ?? null;
        $this->exteriorNumber = $data->exteriorNumber ?? null;
        $this->interiorNumber = $data->interiorNumber ?? null;
        $this->neighborhood = $data->neighborhood ?? null;
        $this->addressReference = $data->addressReference ?? null;
        $this->municipality = $data->municipality ?? null;
        $this->state = $data->state ?? null;
        $this->country = $data->country ?? null;
        $this->postalCode = $data->postalCode ?? null;
        $this->status = $data->status ?? null;
        $this->created_at = $data->created_at ? new DateTimeImmutable($data->created_at) : null;
        $this->updated_at = $data->updated_at ? new DateTimeImmutable($data->updated_at) : null;
    }

    public function toArray(): object
    {
        return (object)[
            'id' => $this->id,
            'street' => $this->street,
            'exteriorNumber' => $this->exteriorNumber,
            'interiorNumber' => $this->interiorNumber,
            'neighborhood' => $this->neighborhood,
            'addressReference' => $this->addressReference,
            'municipality' => $this->municipality,
            'state' => $this->state,
            'country' => $this->country,
            'postalCode' => $this->postalCode,
            'status' => $this->status,
            'created_at' => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : null,
            'updated_at' => $this->updated_at ? $this->updated_at->format('Y-m-d H:i:s') : null,
        ];
    }

    public function __toString(): string
    {
        return (string) $this->id;
    }
}

