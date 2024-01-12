<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\{Auth,Hash};

class MatchPasswordRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = Auth::user();

        if (!$user || !Hash::check($value, $user->password)) {
            $fail('A senha fornecida não corresponde à sua senha atual no banco de dados.');
        }
    }
}
