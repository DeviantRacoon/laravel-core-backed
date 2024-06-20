<?php

namespace App\Modules\Core\UseCases;

use App\Modules\Core\Services\UserService;
use App\Modules\Core\Domain\Entities\UserEntity;

class UserUseCase
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getAllUsers()
    {
        $users = $this->userService->getAllUsers();
        return $users;
    }


}
