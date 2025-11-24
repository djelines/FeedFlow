<?php

namespace App\Http\Requests\Organization;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrganization extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
        ];
    }

    // Add messages method for custom error messages
    public function messages(): array
    {
        return [
            'name.required' => 'The organization name is required.',
            'name.string'   => 'The organization name must be a string.',
            'name.max'      => 'The organization name may not be greater than :max characters.',
        ]; 
    }
}
