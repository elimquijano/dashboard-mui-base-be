<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:roles',
            'description' => 'nullable|string|max:500',
            'status' => 'sometimes|in:active,inactive',
            'permission_ids' => 'sometimes|array',
            'permission_ids.*' => 'exists:permissions,id',
        ];
    }
}
