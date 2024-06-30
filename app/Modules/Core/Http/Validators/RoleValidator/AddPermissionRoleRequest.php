<?php

namespace App\Modules\Core\Http\Validators\RoleValidator;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

class AddPermissionRoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            '*.roleId' => 'required|integer|exists:catalog_roles,id',
            '*.permissionId' => 'required|integer|exists:catalog_permissions,id',
        ];
    }

    public function messages()
    {
        return [
            '*.roleId.required' => 'El rol es requerido.',
            '*.roleId.exists' => 'El rol no existe.',
            '*.permissionId.required' => 'El permiso es requerido.',
            '*.permissionId.exists' => 'El permiso no existe.',
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

    // protected function withValidator($validator)
    // {
    //     $validator->after(function ($validator) {
    //         foreach ($this->all() as $index => $item) {
    //             $roleId = $item['roleId'];
    //             $permissionId = $item['permissionId'];

    //             $exists = DB::table('mixed_role_permissions')
    //                 ->where('role', $roleId)
    //                 ->where('permission', $permissionId)
    //                 ->exists();

    //             if ($exists) {
    //                 $validator->errors()->add("{$index}.role_permission", "La combinación de rol y permiso ya existe en el índice {$index}.");
    //             }
    //         }
    //     });
    // }
}
