<?php

namespace App\Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Core\Application\Models\User;
use App\Modules\Core\Application\UseCases\UserUseCase;
use App\Modules\Core\Http\Validators\UserValidator\UpdateUserRequest;

class UserController
{
    private $userUseCase;

    public function __construct(UserUseCase $userUseCase)
    {
        $this->userUseCase = $userUseCase;
    }

    public function getAllUsers()
    {
        try {
            $users = $this->userUseCase->getAllUsers();

            return response()->json([
                'ok' => true,
                'data' => $users,
                'message' => "Se obtuvieron los usuarios correctamente",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'ok' => false,
                'data' => null,
                'errors' => [$th->getMessage()],
            ]);
        }
    }

    public function getUserByPk($userId)
    {
        try {
            $user = $this->userUseCase->getUserByPk($userId);

            return response()->json([
                'ok' => true,
                'data' => $user,
                'message' => "Se obtuvo el usuario correctamente",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'ok' => false,
                'data' => null,
                'errors' => [$th->getMessage()],
            ]);
        }
    }

    public function getUserByParams(Request $request)
    {
        try {
            $users = $this->userUseCase->getUserByParams((object)$request->all());

            return response()->json([
                'ok' => true,
                'data' => $users,
                'message' => "Se obtuvieron los usuarios correctamente",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'ok' => false,
                'data' => null,
                'errors' => [$th->getMessage()],
            ]);
        }
    }

    public function updateUser(UpdateUserRequest $request)
    {
        try {
            $user = new User($request);
            $users = $this->userUseCase->updateUser($user);

            return response()->json([
                'ok' => true,
                'data' => $users,
                'message' => "Se actualizo el usuario correctamente",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'ok' => false,
                'data' => null,
                'errors' => [$th->getMessage()],
            ]);
        }
    }

}
