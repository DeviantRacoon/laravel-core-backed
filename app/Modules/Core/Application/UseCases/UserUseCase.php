<?php

namespace App\Modules\Core\Application\UseCases;

use App\Modules\Core\Domain\Services\UserService;

class UserUseCase
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getAllUsers()
    {
        $userModels = $this->userService->getAllUsers();
        return array_map(fn($model) => $model->toArray(), $userModels);
    }

    public function getUserByPk($userId)
    {
        $user = $this->userService->getUserByPk($userId);
        return $user->toArray();
    }

    public function getUserByParams($params)
    {
        $userModels = $this->userService->getUserByParams($params);
        return array_map(fn($model) => $model->toArray(), $userModels);
    }

    public function updateUser($params)
    {
        $userModel = $this->userService->updateUser($params);
        return $userModel->toArray();
    }
}
