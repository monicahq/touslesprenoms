<?php

namespace App\Http\Requests\Auth;

use App\Http\Controllers\Auth\PasswordValidationRules;
use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{
    use PasswordValidationRules;

    /**
     * The key to be used for the view error bag.
     *
     * @var string
     */
    protected $errorBag = 'updatePassword';

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'current_password' => 'required|string|current_password',
            'password' => $this->passwordRules(),
        ];
    }
}
