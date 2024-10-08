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
        return [
            'id'                         => 'required|integer|exists:catalog_persons,id',
            'birthDate'                  => 'date_format:Y-m-d',
            'gender'                     => 'string|max:1',

            'additionalData'             => 'array',
            'additionalData.curp'        => 'string|max:18|min:18|unique:catalog_person_additional_data,curp',
            'additionalData.cellphone'   => 'string|unique:catalog_person_additional_data,cellphone',
            'additionalData.photo'       => 'string|max:255',
            'additionalData.addresses'   => 'array',
            
            'additionalData.addresses.id'               => 'integer|exists:catalog_person_addresses,id',
            'additionalData.addresses.street'           => 'string|min:3',
            'additionalData.addresses.exteriorNumber'   => 'string|min:3',
            'additionalData.addresses.interiorNumber'   => 'string|min:3',
            'additionalData.addresses.neighborhood'     => 'string|min:3',
            'additionalData.addresses.addressReference' => 'string|min:3',
            'additionalData.addresses.municipality'     => 'string|min:3',
            'additionalData.addresses.state'            => 'string|min:3',
            'additionalData.addresses.country'          => 'string|min:3',
            'additionalData.addresses.postalCode'       => 'string|max:5|min:5',

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

            'additionalData.array'            => 'El campo additionalData debe ser un arreglo.',
            'additionalData.curp.unique'      => 'La CURP ya existe.',
            'additionalData.curp.max'         => 'La CURP debe tener un máximo de 18 caracteres.',
            'additionalData.curp.min'         => 'La CURP debe tener un mínimo de 18 caracteres.',
            'additionalData.cellphone.unique' => 'El celular ya existe.',
            'additionalData.cellphone.max'    => 'El celular debe tener un máximo de 10 caracteres.',
            'additionalData.cellphone.min'    => 'El celular debe tener un mínimo de 10 caracteres.',
            'additionalData.photo.max'        => 'La foto de la imagen es demasiado grande.',

            'additionalData.addresses.array'                 => 'El campo addresses debe ser un arreglo.',
            'additionalData.addresses.id.integer'            => 'El id de la dirección debe ser un valor numérico.',
            'additionalData.addresses.id.exists'             => 'El id de la dirección no existe.',
            'additionalData.addresses.street.string'         => 'La calle debe ser una cadena de texto.',
            'additionalData.addresses.street.max'            => 'La calle debe tener un máximo de 100 caracteres.',
            'additionalData.addresses.street.min'            => 'La calle debe tener un mínimo de 3 caracteres.',
        ];
    }
}
