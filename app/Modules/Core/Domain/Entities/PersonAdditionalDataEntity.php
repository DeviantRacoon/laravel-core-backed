<?php

namespace App\Modules\Core\Domain\Entities;

use App\Modules\Core\Domain\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Core\Domain\Entities\PersonAddressEntity;

class PersonAdditionalDataEntity extends Model
{
    use HasFactory, UserRepository;

    protected $table = 'catalog_person_additional_data';
    protected $fillable = [
        'curp',
        'cellphone',
        'photo',
        'person_id',
        'status',
    ];

    public function addresses()
    {
        return $this->hasMany(PersonAddressEntity::class, 'person_additional_data_id', 'id');
    }
}

