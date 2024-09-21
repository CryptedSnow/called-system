<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Rules\MatchPasswordRule;

class DetailsUserRequest extends FormRequest
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
            'PATCH' => [
                'name' => ['required'],
                'email' => ['required','email','unique:users,email,' . $this->user()->id],
                'current_password' => ['required', new MatchPasswordRule],
            ],
        };
    }
}
