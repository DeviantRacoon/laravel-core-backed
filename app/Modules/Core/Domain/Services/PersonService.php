<?php

namespace App\Modules\Core\Domain\Services;

use App\Modules\Core\Domain\Entities\PersonEntity;
use App\Modules\Core\Application\Models\Person;

class PersonService
{
    private $personEntity;

    public function __construct(PersonEntity $personEntity)
    {
        $this->personEntity = $personEntity;
    }

    public function getAllPersons()
    {
        $personsQuery = $this->personEntity->get();
        $persons = [];
        foreach ($personsQuery as $person) {
            $persons[] = new Person((object)($person->toArray()));
        }
        return $persons;
    }

    public function getPersonByPk($personId)
    {
        $personQuery = $this->personEntity
            ->wherePersonId($personId)
            ->withRole() 
            ->first();
        return new Person((object)($personQuery->toArray()));
    }

    public function getPersonByParams($params)
    {
        $personsQuery = $this->personEntity->newQuery();

        if (isset($params->name)) {
            $personsQuery->whereNameLike($params->name);
        }

        if (isset($params->email)) {
            $personsQuery->whereEmail($params->email);
        }

        if (isset($params->created_at)) {
            $personsQuery->whereCreatedAt($params->created_at);
        }

        if (isset($params->status)) {
            $personsQuery->whereStatus($params->status);
        }

        $person = [];
        foreach ($personsQuery->get() as $person) {
            $person[] = new Person((object)($person->toArray()));
        }

        return $person;
    }

    public function updatePerson(Person $person)
    {
        $personQuery = $this->personEntity->newQuery();
        $personQuery->updatePerson($person);
        return new Person((object)($personQuery->first()->toArray()));
    }
}
