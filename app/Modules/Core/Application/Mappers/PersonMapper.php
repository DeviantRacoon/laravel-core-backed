<?php

namespace App\Modules\Core\Application\Mappers;

use App\Modules\Core\Application\Models\Person;
USE App\Modules\Core\Application\Models\PersonAdditionalData;

class PersonMapper
{
    public function assignment(Person $person, object $data): void
    {
        if (isset($data->id)) {
            $person->setId($data->id);
        } else {
            $person->setId(null);
        }


        if (isset($data->firstName)) {
            $person->setFirstName($data->firstName);
        } else {
            $person->setFirstName(null);
        }


        if (isset($data->middleName)) {
            $person->setMiddleName($data->middleName);
        } else {
            $person->setMiddleName(null);
        }


        if (isset($data->lastName)) {
            $person->setLastName($data->lastName);
        } else {
            $person->setLastName(null);
        }


        if (isset($data->secondLastName)) {
            $person->setSecondLastName($data->secondLastName);
        } else {
            $person->setSecondLastName(null);
        }


        if (isset($data->gender)) {
            $person->setGender($data->gender);
        } else {
            $person->setGender(null);
        }


        if (isset($data->birthDate)) {
            $person->setBirthDate($data->birthDate);
        } else {
            $person->setBirthDate(null);
        }


        if (isset($data->additional_data) || isset($data->additionalData)) {
            $additionalDataField = $data->additionalData ?? $data->additional_data;
            $additionalDataObject = is_array($additionalDataField) ? (object) $additionalDataField : (object) ["id" => $additionalDataField];
            $additionalData = new PersonAdditionalData($additionalDataObject);
            $person->setAdditionalData($additionalData);
        } else {
            $person->setAdditionalData(null);
        }


        if (isset($data->status)) {
            $person->setStatus($data->status);
        } else {
            $person->setStatus(null);
        }


        if (isset($data->created_at)) {
            $created_at = new \DateTimeImmutable($data->created_at);
            $person->setCreatedAt($created_at);
        } else {
            $person->setCreatedAt(null);
        }


        if (isset($data->updated_at)) {
            $updated_at = new \DateTimeImmutable($data->updated_at);
            $person->setUpdatedAt($updated_at);
        } else {
            $person->setUpdatedAt(null);
        }
    }


    public function jsonToModel(object $data): Person
    {
        $person = new Person();
        $this->assignment($person, $data);
        return $person;
    }


    public function mapToArray(Person $person): array
    {
        return [
            'id' => $person->getId(),
            'firstName' => $person->getFirstName(),
            'middleName' => $person->getMiddleName(),
            'lastName' => $person->getLastName(),
            'secondLastName' => $person->getSecondLastName(),
            'gender' => $person->getGender(),
            'birthDate' => $person->getBirthDate(),
            'additionalData' => $person->getAdditionalData() ? $person->getAdditionalData()->toArray() : $person->getAdditionalData(),
            'status' => $person->getStatus(),
            'created_at' => $person->getCreatedAt() ? $person->getCreatedAt()->format('Y-m-d\TH:i:s.uP') : null,
            'updated_at' => $person->getUpdatedAt() ? $person->getUpdatedAt()->format('Y-m-d\TH:i:s.uP') : null,
        ];
    }


    public function mapToArrayMultiple(array $persons): array
    {
        $mapped = [];
        foreach ($persons as $person) {
            $mapped[] = $this->mapToArray($person);
        }
        return $mapped;
    }

}

