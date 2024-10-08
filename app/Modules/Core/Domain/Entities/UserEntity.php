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

    protected $table = 'catalog_users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'person_id',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(RoleEntity::class, 'role_id');
    }

    public function person()
    {
        return $this->belongsTo(PersonEntity::class);
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
