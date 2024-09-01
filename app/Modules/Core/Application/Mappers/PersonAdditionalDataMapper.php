<?php

namespace App\Modules\Core\Application\Mappers;

use App\Modules\Core\Application\Models\PersonAdditionalData;
use App\Modules\Core\Application\Models\PersonAddress;

class PersonAdditionalDataMapper
{
    public function assignment(PersonAdditionalData $personAdditionalData, $data): void
    {
        if (isset($data->id)) {
            $personAdditionalData->setId($data->id);
        } else {
            $personAdditionalData->setId(null);
        }


        if (isset($data->curp)) {
            $personAdditionalData->setCurp($data->curp);
        } else {
            $personAdditionalData->setCurp(null);
        }


        if (isset($data->cellphone)) {
            $personAdditionalData->setCellphone($data->cellphone);
        } else {
            $personAdditionalData->setCellphone(null);
        }
        

        if (isset($data->photo)) {
            $personAdditionalData->setPhoto($data->photo);
        } else {
            $personAdditionalData->setPhoto(null);
        }


        if (isset($data->addresses)) {
            $personAdditionalData->setAddresses(
                array_map(fn($address) => new PersonAddress((object)$address), $data->addresses)
            );
        } else {
            $personAdditionalData->setAddresses(null);
        }


        if (isset($data->status)) {
            $personAdditionalData->setStatus($data->status);
        } else {
            $personAdditionalData->setStatus(null);
        }


        if (isset($data->created_at)) {
            $created_at = new \DateTimeImmutable($data->created_at);
            $personAdditionalData->setCreatedAt($created_at);
        } else {
            $personAdditionalData->setCreatedAt(null);
        }


        if (isset($data->updated_at)) {
            $updated_at = new \DateTimeImmutable($data->updated_at);
            $personAdditionalData->setUpdatedAt($updated_at);
        } else {
            $personAdditionalData->setUpdatedAt(null);
        }
    }

    public function jsonToModel(object $data): PersonAdditionalData
    {
        $personAdditionalData = new PersonAdditionalData(new \stdClass());
        $this->assignment($personAdditionalData, $data);
        return $personAdditionalData;
    }

    public function mapToArray(PersonAdditionalData $personAdditionalData): array
    {
        return [
            'id' => $personAdditionalData->getId(),
            'curp' => $personAdditionalData->getCurp(),
            'cellphone' => $personAdditionalData->getCellphone(),
            'photo' => $personAdditionalData->getPhoto(),
            'addresses' => $personAdditionalData->arrayAddresses(),
            'status' => $personAdditionalData->getStatus(),
            'created_at' => $personAdditionalData->getCreatedAt() ? $personAdditionalData->getCreatedAt()->format('Y-m-d\TH:i:s.uP') : null,
            'updated_at' => $personAdditionalData->getUpdatedAt() ? $personAdditionalData->getUpdatedAt()->format('Y-m-d\TH:i:s.uP') : null,
        ];
    }

    public function mapToArrayAddresses(PersonAdditionalData $personAdditionalData): array
    {
        $personAddresses = $personAdditionalData->getAddresses();
        $mapped = array_map(fn($address) => $address->toArray(), $personAddresses);
        return $mapped;
    }
}


