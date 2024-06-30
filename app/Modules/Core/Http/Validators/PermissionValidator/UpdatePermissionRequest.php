<?php

namespace App\Modules\Core\Http\Validators\PermissionValidator;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatePermissionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->input('id');
        return [
            'id' => 'required|integer|exists:catalog_permissions,id',
            'name' => 'unique:catalog_permissions,name, ' . $id,
            'description' => 'min:10|max:100',
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
            'description.min' => 'La descripción debe tener un mínimo de 10 caracteres.',
            'description.max' => 'La descripción debe tener un máximo de 100 caracteres.',
        ];
    }
}
