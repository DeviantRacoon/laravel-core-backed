<?php

namespace App\Modules\Core\Application\Mappers;

use App\Modules\Core\Application\Models\PersonAddress;

class PersonAddressMapper
{
    public function assignment(PersonAddress $address, $data): void
    {
        if (isset($data->id)) {
            $address->setId($data->id);
        } else {
            $address->setId(null);
        }


        if (isset($data->street)) {
            $address->setStreet($data->street);
        } else {
            $address->setStreet(null);
        }


        if (isset($data->exteriorNumber)) {
            $address->setExteriorNumber($data->exteriorNumber);
        } else {
            $address->setExteriorNumber(null);
        }


        if (isset($data->interiorNumber)) {
            $address->setInteriorNumber($data->interiorNumber);
        } else {
            $address->setInteriorNumber(null);
        }


        if (isset($data->neighborhood)) {
            $address->setNeighborhood($data->neighborhood);
        } else {
            $address->setNeighborhood(null);
        }


        if (isset($data->addressReference)) {
            $address->setAddressReference($data->addressReference);
        } else {
            $address->setAddressReference(null);
        }


        if (isset($data->municipality)) {
            $address->setMunicipality($data->municipality);
        } else {
            $address->setMunicipality(null);
        }


        if (isset($data->state)) {
            $address->setState($data->state);
        } else {
            $address->setState(null);
        }


        if (isset($data->country)) {
            $address->setCountry($data->country);
        } else {
            $address->setCountry(null);
        }


        if (isset($data->postalCode)) {
            $address->setPostalCode($data->postalCode);
        } else {
            $address->setPostalCode(null);
        }


        if (isset($data->status)) {
            $address->setStatus($data->status);
        } else {
            $address->setStatus(null);
        }


        if (isset($data->created_at)) {
            $created_at = new \DateTimeImmutable($data->created_at);
            $address->setCreatedAt($created_at);
        } else {
            $address->setCreatedAt(null);
        }


        if (isset($data->updated_at)) {
            $updated_at = new \DateTimeImmutable($data->updated_at);
            $address->setUpdatedAt($updated_at);
        } else {
            $address->setUpdatedAt(null);
        }
    }


    public function jsonToModel(object $data): PersonAddress
    {
        $address = new PersonAddress();
        $this->assignment($address, $data);
        return $address;
    }


    public function mapToArray(PersonAddress $address): array
    {
        return [
            'id' => $address->getId(),
            'street' => $address->getStreet(),
            'exteriorNumber' => $address->getExteriorNumber(),
            'interiorNumber' => $address->getInteriorNumber(),
            'neighborhood' => $address->getNeighborhood(),
            'addressReference' => $address->getAddressReference(),
            'municipality' => $address->getMunicipality(),
            'state' => $address->getState(),
            'country' => $address->getCountry(),
            'postalCode' => $address->getPostalCode(),
            'status' => $address->getStatus(),
            'created_at' => $address->getCreatedAt() ? $address->getCreatedAt()->format('Y-m-d H:i:s') : null,
            'updated_at' => $address->getUpdatedAt() ? $address->getUpdatedAt()->format('Y-m-d H:i:s') : null,
        ];
    }


    public function mapToArrayMultiple(array $addresses): array
    {
        $mapped = [];
        foreach ($addresses as $address) {
            $mapped[] = $this->mapToArray($address);
        }
        dump($mapped);
        return $mapped;
    }

}


