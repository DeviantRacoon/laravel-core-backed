<?php

namespace App\Modules\Core\Http\Validators\PermissionValidator;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreatePermissionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'unique:catalog_permissions,name|min:3|max:20|required',
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
            'name.required' => 'El nombre es requerido.',
            'name.unique' => 'El nombre ya existe.',
            'name.min' => 'El nombre debe tener un mínimo de 3 caracteres.',
            'name.max' => 'El nombre debe tener un máximo de 20 caracteres.',
        ];
    }
}
