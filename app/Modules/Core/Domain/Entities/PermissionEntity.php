<?php

namespace App\Modules\Core\Domain\Entities;

use App\Modules\Core\Domain\Repositories\PermissionRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

use App\Modules\Core\Domain\Entities\RoleEntity;

class PermissionEntity extends Model
{
    use HasFactory, Notifiable, PermissionRepository; 

    protected $table = 'catalog_permissions';
    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    public function roles()
    {
        return $this->belongsToMany(RoleEntity::class, 'mixed_role_permissions', 'permission', 'role');
    }
    
    
}
