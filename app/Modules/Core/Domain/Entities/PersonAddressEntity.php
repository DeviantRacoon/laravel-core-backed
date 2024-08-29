<?php

namespace App\Modules\Core\Domain\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonAddressEntity extends Model
{
    use HasFactory;

    protected $table = 'catalog_person_address';

    protected $fillable = [
        'street',
        'exteriorNumber',
        'interiorNumber',
        'neighborhood',
        'address_reference',
        'municipality',
        'state',
        'country',
        'postalCode',
        'status',
    ];

    public function additionalData()
    {
        return $this->belongsTo(PersonAdditionalDataEntity::class, 'address_id', 'id');
    }
}
