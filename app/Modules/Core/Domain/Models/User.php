<?php

namespace App\Modules\Core\Domain\Models;

use Monolog\DateTimeImmutable;

class User
{

    private ?int $id;
    private ?string $name;
    private ?string $email;
    private ?string $email_verified_at;
    private ?string $password;
    private ?string $remember_token;
    private ?int $status;
    private ?DateTimeImmutable $created_at;
    private ?DateTimeImmutable  $updated_at;

    public function __construct($data)
    {
        $this->id = $data->id;
        $this->name = $data->name;
        $this->email = $data->email;
        $this->email_verified_at = $data->email_verified_at;
        $this->password = $data->password;
        $this->remember_token = $data->remember_token;
        $this->status = $data->status;
        $this->created_at = $data->created_at;
        $this->updated_at = $data->updated_at;
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


    public function getEmailVerifiedAt(): ?string
    {
        return $this->email_verified_at;
    }

    public function setEmailVerifiedAt(?string $email_verified_at): void
    {
        $this->email_verified_at = $email_verified_at;
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
            'email_verified_at' => $this->email_verified_at,
            'password' => $this->password,
            'remember_token' => $this->remember_token,
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
