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
        return [
            'id' => 'required|integer|exists:users,id',
            'name' => 'unique:users,name',
            'email' => 'unique:users,email',
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
            'name.unique' => 'El nombre ya existe.',
            'email.unique' => 'El correo ya existe.',
        ];
    }
}
