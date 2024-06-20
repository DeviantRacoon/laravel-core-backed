<?php

namespace App\Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Modules\Core\UseCases\UserUseCase;

use App\Modules\Core\Domain\Entities\UserEntity;

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
                'message' => $th->getMessage(),
            ]);
        }
    }




}
