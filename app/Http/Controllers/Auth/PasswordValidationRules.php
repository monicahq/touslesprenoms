<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Validation\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array<int, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    protected function passwordRules(): array
    {
        return [
            'required',
            'string',
            app()->environment('local') || app()->environment('testing')
                ? Password::min(4)
                : ($this->isPrecognitive()
                    ? Password::default()
                    : Password::default()->uncompromised()),
            'confirmed',
        ];
    }
}
