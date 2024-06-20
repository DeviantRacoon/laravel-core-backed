<?php

namespace App\Modules\Core\Domain\Entities;

use Laravel\Sanctum\HasApiTokens;
use App\Modules\Core\Domain\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserEntity extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UserRepository; 

    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
