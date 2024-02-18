<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    /**
     * Indicates that the request is made via Htmx.
     */
    public function isHtmxRequest(): bool
    {
        return filter_var($this->headers->get('HX-Request', 'false'), FILTER_VALIDATE_BOOLEAN);
    }

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'term' => 'required|string|alpha_dash|min:3|max:255',
        ];
    }
}
