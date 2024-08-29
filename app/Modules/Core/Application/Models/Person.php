<?php

namespace App\Modules\Core\Application\Models;

use \DateTimeImmutable;

class Person
{
    public const ACTIVE   = 1;
    public const INACTIVE = 2;
    public const PENDING  = 3;
    public const DELETED  = 99;

    private ?int $id;
    private ?string $firstName;
    private ?string $middleName;
    private ?string $lastName;
    private ?string $secondLastName;
    private ?string $gender;
    private ?string $birthDate;
    private ?int $status;
    private ?DateTimeImmutable $created_at;
    private ?DateTimeImmutable $updated_at;

    public function __construct($data)
    {
        $this->id = $data->id ?? null;
        $this->firstName = $data->firstName ?? null;
        $this->middleName = $data->middleName ?? null;
        $this->lastName = $data->lastName ?? null;
        $this->secondLastName = $data->secondLastName ?? null;
        $this->gender = $data->gender ?? null;
        $this->birthDate = $data->birthDate ?? null;
        $this->status = $data->status ?? null;
        $this->created_at = $data->created_at ? new DateTimeImmutable($data->created_at) : null;
        $this->updated_at = $data->updated_at ? new DateTimeImmutable($data->updated_at) : null;
    }

    public function toArray(): object
    {
        return (object)[
            'id' => $this->id,
            'firstName' => $this->firstName,
            'middleName' => $this->middleName,
            'lastName' => $this->lastName,
            'secondLastName' => $this->secondLastName,
            'gender' => $this->gender,
            'birthDate' => $this->birthDate,
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
