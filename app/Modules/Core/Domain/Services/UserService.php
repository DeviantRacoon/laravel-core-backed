<?php

namespace App\Modules\Core\Domain\Services;

use App\Modules\Core\Domain\Entities\UserEntity;
use App\Modules\Core\Application\Models\User;

class UserService
{
    private $userEntity;

    public function __construct()
    {
        $this->userEntity = new UserEntity();
    }

    public function getAllUsers()
    {
        $usersQuery = $this->userEntity->get();
        $users = [];
        foreach ($usersQuery as $user) {
            $users[] = new User((object)($user->toArray()));
        }
        return $users;
    }

    public function getUserByPk($userId)
    {
        $userQuery = $this->userEntity
            ->whereUserId($userId)
            ->withRole() 
            ->withPerson()
            ->first();
        return new User((object)($userQuery->toArray()));
    }

    public function getUserByParams($params)
    {
        $usersQuery = $this->userEntity->newQuery();

        if (isset($params->name)) {
            $usersQuery->whereNameLike($params->name);
        }

        if (isset($params->email)) {
            $usersQuery->whereEmail($params->email);
        }

        if (isset($params->created_at)) {
            $usersQuery->whereCreatedAt($params->created_at);
        }

        if (isset($params->status)) {
            $usersQuery->whereStatus($params->status);
        }

        $users = [];
        foreach ($usersQuery->get() as $user) {
            $users[] = new User((object)($user->toArray()));
        }

        return $users;
    }

    public function updateUser(User $user)
    {
        $userQuery = $this->userEntity->newQuery();
        $userQuery->updateUser($user);
        return new User((object)($userQuery->first()->toArray()));
    }
}
