<?php

namespace App\Modules\Core\Application\UseCases;

use App\Modules\Core\Domain\Services\PersonService;

class PersonUseCase
{
    private $personService;

    public function __construct(PersonService $personService)
    {
        $this->personService = $personService;
    }

    public function getAllPersons()
    {
        $personModels = $this->personService->getAllPersons();
        return array_map(fn($model) => $model->toArray(), $personModels);
    }

    public function getPersonByPk($personId)
    {
        $person = $this->personService->getPersonByPk($personId);
        return $person->toArray();
    }

    public function getPersonsByParams($params)
    {
        $personModels = $this->personService->getPersonsByParams($params);
        $personModels['items'] = array_map(fn($model) => $model->toArray(), $personModels['items']);
        return $personModels;
    }

    public function createPerson($params)
    {
        $personModel = $this->personService->createPerson($params);
        return $personModel->toArray();
    }

    public function updatePerson($params)
    {
        $personModel = $this->personService->updatePerson($params);
        return $personModel->toArray();
    }
}
