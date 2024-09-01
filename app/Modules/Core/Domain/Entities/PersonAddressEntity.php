<?php

namespace App\Modules\Core\Domain\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonAddressEntity extends Model
{
    use HasFactory;

    protected $table = 'catalog_person_address';

    protected $fillable = [
        'person_additional_data_id',
        'street',
        'exteriorNumber',
        'interiorNumber',
        'neighborhood',
        'addressReference',
        'municipality',
        'state',
        'country',
        'postalCode',
        'status',
    ];

    public function additionalData()
    {
        return $this->belongsTo(PersonAdditionalDataEntity::class , 'id', 'person_additional_data_id');
    }
}
