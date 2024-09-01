<?php

namespace App\Modules\Core\Domain\Entities;

use App\Modules\Core\Domain\Repositories\PersonRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonEntity extends Model
{
    use HasFactory, PersonRepository;

    protected $table = 'catalog_persons';
    protected $fillable = [
        'firstName',
        'middleName',
        'lastName',
        'secondLastName',
        'gender',
        'birthDate',
    ];

    public function user()
    {
        return $this->belongsTo(UserEntity::class);
    }

    public function additionalData()
    {
        return $this->hasOne(PersonAdditionalDataEntity::class, 'person_id', 'id');
    }

    public function addresses()
    {
        return $this->hasMany(PersonAddressEntity::class, 'person_additional_data_id', 'id');
    }
}
