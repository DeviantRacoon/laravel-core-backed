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
            'firstName'                  => 'required|string|max:20|min:3',
            'lastName'                   => 'required|string|max:20|min:3',
            'secondLastName'             => 'required|string|max:20|min:3',
            'birthDate'                  => 'required|date_format:Y-m-d',
            'gender'                     => 'required|string|max:1',
            'additionalData.curp'        => 'required|string|max:18|min:18|unique:catalog_person_additional_data,curp',
            'additionalData.cellphone'   => 'required|string|unique:catalog_person_additional_data,cellphone',
            'additionalData.photo'       => 'string|max:255',
            'addresses.street'           => 'required|string|min:3',
            'addresses.exteriorNumber'   => 'required|string|min:3',
            'addresses.interiorNumber'   => 'required|string|min:3',
            'addresses.neighborhood'     => 'required|string|min:3',
            'addresses.addressReference' => 'required|string|min:3',
            'addresses.municipality'     => 'required|string|min:3',
            'addresses.state'            => 'required|string|min:3',
            'addresses.country'          => 'required|string|min:3',
            'addresses.postalCode'       => 'required|string|max:5|min:5',

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
            'firstName.required'       => 'El nombre es requerido.',
            'firstName.string'         => 'El nombre debe ser una cadena de texto.',
            'firstName.max'            => 'El nombre debe tener un máximo de 20 caracteres.',
            'firstName.min'            => 'El nombre debe tener un mínimo de 3 caracteres.',
            'lastName.required'        => 'El apellido es requerido.',
            'lastName.string'          => 'El apellido debe ser una cadena de texto.',
            'lastName.max'             => 'El apellido debe tener un máximo de 20 caracteres.',
            'lastName.min'             => 'El apellido debe tener un mínimo de 3 caracteres.',
            'secondLastName.required'  => 'El segundo apellido es requerido.',
            'secondLastName.string'    => 'El segundo apellido debe ser una cadena de texto.',
            'secondLastName.max'       => 'El segundo apellido debe tener un máximo de 20 caracteres.',
            'secondLastName.min'       => 'El segundo apellido debe tener un mínimo de 3 caracteres.',
            'birthDate.required'       => 'La fecha de nacimiento es requerida.',
            'birthDate.date_format'    => 'La fecha de nacimiento debe ser una fecha válida.',           
            'gender.required'          => 'El genero es requerido.',
            'gender.string'            => 'El genero debe ser una cadena de texto.',
            'gender.max'               => 'El genero debe tener un máximo de 1 caracteres.',
            'gender.min'               => 'El genero debe tener un mínimo de 1 caracteres.',

            'additionalData.curp.unique'      => 'La CURP ya existe.',
            'additionalData.curp.max'         => 'La CURP debe tener un máximo de 18 caracteres.',
            'additionalData.curp.min'         => 'La CURP debe tener un mínimo de 18 caracteres.',
            'additionalData.cellphone.unique' => 'El celular ya existe.',
            'additionalData.cellphone.max'    => 'El celular debe tener un máximo de 10 caracteres.',
            'additionalData.cellphone.min'    => 'El celular debe tener un mínimo de 10 caracteres.',
            'additionalData.photo.max'        => 'La foto de la imagen es demasiado grande.',
            'addresses.street.required'       => 'La calle es requerida.',
            'addresses.street.string'         => 'La calle debe ser una cadena de texto.',
            'addresses.street.max'            => 'La calle debe tener un máximo de 100 caracteres.',
            'addresses.street.min'            => 'La calle debe tener un mínimo de 3 caracteres.',

            'addresses.exteriorNumber.required'     => 'El exterior es requerido.',
            'addresses.exteriorNumber.string'       => 'El exterior debe ser una cadena de texto.',
            'addresses.exteriorNumber.min'          => 'El exterior debe tener un mínimo de 3 caracteres.',
            'addresses.interiorNumber.required'     => 'El interior es requerido.',
            'addresses.interiorNumber.string'       => 'El interior debe ser una cadena de texto.',
            'addresses.interiorNumber.min'          => 'El interior debe tener un mínimo de 3 caracteres.',
            'addresses.neighborhood.required'       => 'La colonia es requerida.',
            'addresses.neighborhood.string'         => 'La colonia debe ser una cadena de texto.',
            'addresses.neighborhood.min'            => 'La colonia debe tener un mínimo de 3 caracteres.',
            'addresses.addressReference.required'   => 'La referencia es requerida.',
            'addresses.addressReference.string'     => 'La referencia debe ser una cadena de texto.',
            'addresses.addressReference.min'        => 'La referencia debe tener un mínimo de 3 caracteres.',
            'addresses.municipality.required'       => 'La colonia es requerida.',
            'addresses.municipality.string'         => 'La colonia debe ser una cadena de texto.',
            'addresses.municipality.min'            => 'La colonia debe tener un mínimo de 3 caracteres.',
            'addresses.state.required'              => 'El estado es requerido.',
            'addresses.state.string'                => 'El estado debe ser una cadena de texto.',
            'addresses.state.min'                   => 'El estado debe tener un mínimo de 3 caracteres.',
            'addresses.country.required'            => 'El país es requerido.',
            'addresses.country.string'              => 'El país debe ser una cadena de texto.',
            'addresses.country.max'                 => 'El país debe tener un máximo de 100 caracteres.',
            'addresses.country.min'                 => 'El país debe tener un mínimo de 3 caracteres.',
            'addresses.postalCode.required'         => 'El CP es requerido.',
            'addresses.postalCode.string'           => 'El CP debe ser una cadena de texto.',
            'addresses.postalCode.max'              => 'El CP debe tener un máximo de 5 caracteres.',
            'addresses.postalCode.min'              => 'El CP debe tener un mínimo de 5 caracteres.',
        ];
    }
}
