<?php

namespace App\Modules\Core\Domain\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Core\Application\Models\User;

trait UserRepository
{

    /* --------------------------------- SELECT --------------------------------- */

    public function getAll(): ?Collection
    {
        return $this->all();
    }


    /* --------------------------------- CREATE OR UPDATE --------------------------------- */

    public function scopeUpdateUser($query, User $user)
    {
        $params = collect($user->toArray())->filter()->all();
        return $query->where('id', $user->getId())->update($params);
    }

    /* ---------------------------------- WHERE --------------------------------- */

    public function whereEmail(string $email)
    {
        return $this->where('email', $email);
    }

    public function whereUserId($userId)
    {
        return $this->where('id', $userId);
    }

    public function whereStatus($status)
    {
        return $this->where('status', $status);
    }

    public function whereCreatedAt($createdAt)
    {
        return $this->where('created_at', $createdAt);
    }

    public function scopeBetweenCreatedAt($query, $from, $to)
    {
        return $query->whereBetween('created_at', [$from, $to]);
    }

    public function scopeWhereNameLike($query, $name)
    {
        return $query->where('name', 'like', '%' . $name . '%');
    }
}
