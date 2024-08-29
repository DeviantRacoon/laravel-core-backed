<?php

namespace App\Modules\Core\Http\Validators\PersonValidator;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatePersonRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->input('id');
        return [
            'id'        => 'required|integer|exists:catalog_persons,id',
            'birthDate' => 'date_format:Y-m-d',
            'gender'    => 'string|max:1',

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
            'id.required'           => 'No se envió el campo id.',
            'id.integer'            => 'El id debe ser un valor numérico.',
            'id.exists'             => 'El id no existe.',
            'birthDate.date_format' => 'La fecha de nacimiento debe ser una fecha válida.',
            'gender.string'         => 'El genero debe ser una cadena de texto.',
            'gender.max'            => 'El genero debe tener un máximo de 1 caracteres.',
        ];
    }
}
