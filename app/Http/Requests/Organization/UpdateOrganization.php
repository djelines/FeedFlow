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
            'name' => ['string', 'max:255'],
            'plan' => ['string', 'in:free,premium'],
        ];
    }

    /**
     * Add messages method for custom error messages
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.string'   => 'The organization name must be a string.',
            'name.max'      => 'The organization name may not be greater than :max characters.',
            'plan.string'   => 'The organization plan must be a string.',
            'plan.in'       => 'The organization plan must be free or premium.',
        ];
    }
}
