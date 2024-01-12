<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return match ($this->method()) {
            'POST' => [
                'name' => 'required|min:4|unique:roles,name,NULL,idColumn COLLATE utf8_general_ci',
                'permissions' => 'required|exists:permissions,name',
            ],
            'PATCH' => [
                'name' => 'required|min:4',
                'permissions' => 'required|exists:permissions,name',
            ],
        };
    }
}
