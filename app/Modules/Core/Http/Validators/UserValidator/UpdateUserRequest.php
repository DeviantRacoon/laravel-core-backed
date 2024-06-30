<?php

namespace App\Modules\Core\Http\Validators\UserValidator;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->input('id');
        return [
            'id' => 'required|integer|exists:catalog_users,id',
            'name' => 'unique:catalog_users,name,' . $id,
            'email' => 'email|unique:catalog_users,email,' . $id,
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
            'id.required' => 'No se envió el campo id.',
            'id.integer' => 'El id debe ser un valor numérico.',
            'id.exists' => 'El id no existe.',
            'name.required' => 'El nombre es requerido.',
            'name.unique' => 'El nombre ya existe.',
            'email.required' => 'El correo es requerido.',
            'email.email' => 'El correo debe ser un correo válido.',
            'email.unique' => 'El correo ya existe.',
        ];
    }
}
