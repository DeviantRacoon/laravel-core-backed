<?php

namespace App\Modules\Core\Http\Validators\PersonValidator;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreatePersonRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'firstName'         => 'required|string|max:20|min:3',
            'lastName'          => 'required|string|max:20|min:3',
            'secondLastName'    => 'required|string|max:20|min:3',
            'birthDate'         => 'required|date_format:Y-m-d',
            'gender'            => 'required|string|max:1',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = collect($validator->errors())
            ->flatten()
            ->map(function ($error) {
                return $error;
            })
            ->all();

        throw new HttpResponseException(response()->json([
            'ok' => false,
            'message' => 'La información no es válida.',
            'errors' => $errors,
        ], 422));
    }

    public function messages()
    {
        return [
            'firstName.required'        => 'El nombre es requerido.',
            'firstName.string'          => 'El nombre debe ser una cadena de texto.',
            'firstName.max'             => 'El nombre debe tener un máximo de 20 caracteres.',
            'firstName.min'             => 'El nombre debe tener un mínimo de 3 caracteres.',
            'lastName.required'         => 'El apellido es requerido.',
            'lastName.string'           => 'El apellido debe ser una cadena de texto.',
            'lastName.max'              => 'El apellido debe tener un máximo de 20 caracteres.',
            'lastName.min'              => 'El apellido debe tener un mínimo de 3 caracteres.',
            'secondLastName.required'   => 'El segundo apellido es requerido.',
            'secondLastName.string'     => 'El segundo apellido debe ser una cadena de texto.',
            'secondLastName.max'        => 'El segundo apellido debe tener un máximo de 20 caracteres.',
            'secondLastName.min'        => 'El segundo apellido debe tener un mínimo de 3 caracteres.',
            'birthDate.required'        => 'La fecha de nacimiento es requerida.',
            'birthDate.date_format'     => 'La fecha de nacimiento debe ser una fecha válida.',           
            'gender.required'           => 'El genero es requerido.',
            'gender.string'             => 'El genero debe ser una cadena de texto.',
            'gender.max'                => 'El genero debe tener un máximo de 1 caracteres.',
            'gender.min'                => 'El genero debe tener un mínimo de 1 caracteres.',
        ];
    }
}
