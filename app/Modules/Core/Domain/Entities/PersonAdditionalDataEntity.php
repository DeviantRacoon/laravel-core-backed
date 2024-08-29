<?php

namespace App\Modules\Core\Domain\Entities;

use App\Modules\Core\Domain\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Core\Domain\Entities\PersonEntity;
use App\Modules\Core\Domain\Entities\PersonAdditionalDataEntity as AdditionalData;

class PersonAdditionalDataEntity extends Model
{
    use HasFactory, UserRepository;

    protected $table = 'catalog_person_additional_data';
    protected $fillable = [
        'curp',
        'cellphone',
        'address_id',
        'photo',
        'person_id',
        'status',
    ];

    public function person()
    {
        return $this->belongsTo(PersonEntity::class, 'person_id', 'id');
    }

    public function addresses()
    {
        return $this->hasMany(AdditionalData::class, 'address_id', 'id');
    }
}

