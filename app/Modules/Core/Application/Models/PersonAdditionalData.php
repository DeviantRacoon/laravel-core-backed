<?php

namespace App\Modules\Core\Application\Models;
use \DateTimeImmutable;

class PersonAdditionalData
{
    public const ACTIVE   = 1;
    public const INACTIVE = 2;
    public const PENDING  = 3;
    public const DELETED  = 99;

    private ?int $id;
    private ?string $curp;
    private ?string $cellphone;
    private ?string $photo;
    private ?int $address_id;
    private ?int $person_id;
    private ?int $status;
    private ?DateTimeImmutable $created_at;
    private ?DateTimeImmutable $updated_at;

    public function __construct($data)
    {
        $this->id = $data->id ?? null;
        $this->curp = $data->curp ?? null;
        $this->cellphone = $data->cellphone ?? null;
        $this->photo = $data->photo ?? null;
        $this->address_id = $data->address_id ?? null;
        $this->person_id = $data->person_id ?? null;
        $this->status = $data->status ?? null;
        $this->created_at = $data->created_at ? new DateTimeImmutable($data->created_at) : null;
        $this->updated_at = $data->updated_at ? new DateTimeImmutable($data->updated_at) : null;
    }

    public function toArray(): object
    {
        return (object)[
            'id' => $this->id,
            'curp' => $this->curp,
            'cellphone' => $this->cellphone,
            'photo' => $this->photo,
            'address_id' => $this->address_id,
            'person_id' => $this->person_id,
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


