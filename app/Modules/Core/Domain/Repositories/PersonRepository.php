<?php

namespace App\Modules\Core\Domain\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Core\Application\Models\Person;

trait PersonRepository
{

    /* --------------------------------- SELECT --------------------------------- */

    public function getAll(): ?Collection
    {
        return $this->all();
    }


    /* ---------------------------- CREATE OR UPDATE ---------------------------- */

    public function scopeCreatePerson($query, Person $person)
    {
        $params = collect($person->toArray())->filter()->all();
        $personEntity = $query->create($params);

        $addresses = $person->getAdditionalData()->arrayAddresses();
        $addressesParams = array_map(fn($address) => collect($address)->filter()->all(), $addresses);

        $additionalDataParams = collect($person->getAdditionalData()->toArray())->filter()->all();

        $personAdditionalData = $personEntity->additionalData()->create($additionalDataParams);
        $personAdditionalData->addresses()->createMany($addressesParams);

        return $personEntity;
    }


    public function scopeUpdatePerson($query, Person $person)
    {
        $personParams = collect($person->toArray())->filter()->all();
        unset($personParams['additionalData']);

        $additionalDataParams = collect($person->getAdditionalData()->toArray())->filter()->all();
        unset($additionalDataParams['addresses']);

        $addresses = $person->getAdditionalData()->arrayAddresses();
        $addressesParams = array_map(fn($address) => collect($address)->filter()->all(), $addresses);

        $query->where('id', $person->getId())->update($personParams);
        $personEntity = $query->whereId($person->getId())->first();

        $personEntity->additionalData()->update($additionalDataParams);

        foreach ($addressesParams as $address) {
            $personEntity->additionalData->addresses()->updateOrCreate(["id" => $address["id"] ?? null], $address);
        }
        
        return $personEntity;
    }


    /* ------------------------------ RELATIONSHIPS ----------------------------- */


    public function scopeWithPersonAdditionalData($query)
    {
        return $query->with('additionalData');
    }

    public function scopeWithPersonAdditionalDataAndAddresses($query)
    {
        return $query->with('additionalData.addresses');
    }


    /* ---------------------------------- WHERE --------------------------------- */

    public function scopeWhereLikeFirstName($query, string $firstName)
    {
        return $this->$query->where('firstName', 'like', '%' . $firstName . '%');
    }

    public function scopeWhereLikeMiddleName($query, string $middleName)
    {
        return $this->$query->where('middleName', 'like', '%' . $middleName . '%');
    }

    public function scopeWhereLikeLastName($query, string $lastName)
    {
        return $this->$query->where('lastName', 'like', '%' . $lastName . '%');
    }

    public function scopeWhereLikeSecondLastName($query, string $lastName)
    {
        return $this->$query->where('lastName', 'like', '%' . $lastName . '%');
    }

    public function wherePersonId($personId)
    {
        return $this->where('id', $personId);
    }

    public function whereStatus($status)
    {
        return $this->where('status', $status);
    }

    public function whereCreatedAt($createdAt)
    {
        return $this->where('created_at', $createdAt);
    }

    public function scopeBetweenCreatedAt($query, $from, $to)
    {
        return $query->whereBetween('created_at', [$from, $to]);
    }

    public function scopeWhereNameLike($query, $name)
    {
        return $query->where('name', 'like', '%' . $name . '%');
    }
}
