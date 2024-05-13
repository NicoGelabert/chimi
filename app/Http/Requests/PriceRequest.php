<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriceRequest extends FormRequest
{
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'number' => ['required', 'numeric'],
            'size' => ['nullable', 'string'],
            'product' => ['nullable', 'numeric'],
            // 'product.*' => ['nullable', 'numeric', 'exists:product,id'],
        ];
    }
}
