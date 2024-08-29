<?php

namespace App\Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Core\Application\Models\Person;
use App\Modules\Core\Application\UseCases\PersonUseCase;
use App\Modules\Core\Http\Validators\PersonValidator\UpdatePersonRequest;
use App\Modules\Core\Http\Validators\PersonValidator\CreatePersonRequest;

class PersonController
{
    private $personUseCase;

    public function __construct(PersonUseCase $personUseCase)
    {
        $this->personUseCase = $personUseCase;
    }

    public function getAllPersons()
    {
        try {
            $persons = $this->personUseCase->getAllPersons();

            return response()->json([
                'ok' => true,
                'data' => $persons,
                'message' => "Se obtuvieron las personas correctamente",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'ok' => false,
                'data' => null,
                'errors' => [$th->getMessage()],
            ]);
        }
    }

    public function getPersonByPk($personId)
    {
        try {
            $person = $this->personUseCase->getPersonByPk($personId);

            return response()->json([
                'ok' => true,
                'data' => $person,
                'message' => "Se obtuvo la persona correctamente",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'ok' => false,
                'data' => null,
                'errors' => [$th->getMessage()],
            ]);
        }
    }

    public function getPersonsByParams(Request $request)
    {
        try {
            $persons = $this->personUseCase->getPersonsByParams((object)$request->all());

            return response()->json([
                'ok' => true,
                'data' => $persons,
                'message' => "Se obtuvieron las personas correctamente",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'ok' => false,
                'data' => null,
                'errors' => [$th->getMessage()],
            ]);
        }
    }

    public function updatePerson(UpdatePersonRequest $request)
    {
        try {
            $person = new Person($request);
            $persons = $this->personUseCase->updatePerson($person);

            return response()->json([
                'ok' => true,
                'data' => $persons,
                'message' => "Se actualizo la persona correctamente",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'ok' => false,
                'data' => null,
                'errors' => [$th->getMessage()],
            ]);
        }
    }

    public function createPerson(CreatePersonRequest $request)
    {
        try {
            $person = new Person($request);
            $personCreated = $this->personUseCase->createPerson($person);

            return response()->json([
                'ok' => true,
                'data' => $personCreated,
                'message' => "Se creo la persona correctamente",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'ok' => false,
                'data' => null,
                'errors' => [$th->getMessage()],
            ]);
        }
    }

}
