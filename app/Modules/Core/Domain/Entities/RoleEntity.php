<?php

namespace App\Modules\Core\Domain\Entities;

use App\Modules\Core\Domain\Repositories\RoleRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class RoleEntity extends Model
{
    use HasFactory, Notifiable, RoleRepository; 

    protected $table = 'catalog_roles';
    protected $fillable = [
        'name',
        'description',
        'status',
    ];
    
}
