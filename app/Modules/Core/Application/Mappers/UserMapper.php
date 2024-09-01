<?php

namespace App\Modules\Core\Application\Mappers;

use App\Modules\Core\Application\Models\User;
use App\Modules\Core\Application\Models\Role;

class UserMapper
{
    public function assignment(User $user, object $data): void
    {
        if (isset($data->id)) {
            $user->setId($data->id);
        } else {
            $user->setId(null);
        }


        if (isset($data->name)) {
            $user->setName($data->name);
        } else {
            $user->setName(null);
        }


        if (isset($data->email)) {
            $user->setEmail($data->email);
        } else {
            $user->setEmail(null);
        }


        if (isset($data->password)) {
            $user->setPassword($data->password);
        } else { 
            $user->setPassword(null);
        }


        if (isset($data->role)) {
            $roleObject = is_array($data->role) ? (object) $data->role : (object) ["id" => $data->role];
            $role = new Role($roleObject);
            $user->setRole($role);
        } else {
            $user->setRole(null);
        }


        if (isset($data->status)) {
            $user->setStatus($data->status);
        } else { 
            $user->setStatus(null);
        }


        if (isset($data->created_at)) {
            $created_at = new \DateTimeImmutable($data->created_at);
            $user->setCreatedAt($created_at);
        } else { 
            $user->setCreatedAt(null);
        }


        if (isset($data->updated_at)) {
            $updated_at = new \DateTimeImmutable($data->updated_at);
            $user->setUpdatedAt($updated_at);
        } else { 
            $user->setUpdatedAt(null);
        }
    }


    public function jsonToModel(object $data): User
    {
        $user = new User();
        $this->assignment($user, $data);
        return $user;
    }


    public function mapToArray(User $user): array
    {
        return [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'role' => $user->getRole() ? $user->getRole()->toArray() : $user->getRole(),
            'status' => $user->getStatus(),
            'created_at' => $user->getCreatedAt() ? $user->getCreatedAt()->format('Y-m-d\TH:i:s.uP') : null,
            'updated_at' => $user->getUpdatedAt() ? $user->getUpdatedAt()->format('Y-m-d\TH:i:s.uP') : null,
        ];
    }


    public function mapToArrayMultiple(array $users): array
    {
        $mapped = [];
        foreach ($users as $user) {
            $mapped[] = $this->mapToArray($user);
        }
        return $mapped;
    }

}
