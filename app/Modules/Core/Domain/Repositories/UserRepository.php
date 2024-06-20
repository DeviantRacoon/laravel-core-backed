<?php

namespace App\Modules\Core\Domain\Repositories;

use App\Modules\Core\Domain\Entities\UserEntity;
use App\Illuminate\Database\Eloquent\Collection;
trait UserRepository
{
    public function getAll(): ?\Illuminate\Database\Eloquent\Collection
    {
        return $this->all();
    }

    public function whereEmail(string $email): ?UserEntity
    {
        return $this->where('email', $email)->first();
    }

    public function whereUserId($userId)
    {
        return $this->where('id', $userId);
    }

    public function whereStatusId($statusId)
    {
        return $this->where('id', $statusId);
    }
}
