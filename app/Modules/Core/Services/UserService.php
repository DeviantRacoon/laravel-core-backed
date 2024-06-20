<?php

namespace App\Modules\Core\Services;

use App\Modules\Core\Domain\Entities\UserEntity;
use App\Modules\Core\Domain\Repositories\UserRepository;

class UserService
{
    private $userEntity;

    public function __construct(UserEntity $userEntity)
    {
        $this->userEntity = $userEntity;
    }

    public function getAllUsers()
    {
        $users = $this->userEntity
            ->whereUserId(1)
            ->get();
        return $users;
    }
}
