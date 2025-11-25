<?php

namespace App\Http\Requests\Organization;

use App\Models\OrganizationUser;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool{
        return true;
    }

    /**
     * Prepare data before validation
     */
    protected function prepareForValidation()
    {
        if ($this->has('email')) {
            $userId = User::where('email', $this->input('email'))->value('id');

            $this->merge([
                'user_id' => $userId
            ]);
        }
    }

    /**
     * Rules validation
     * @return array
     */
    public function rules(): array {
        return [
            'user_id' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    $is_present = (new OrganizationUser)->isUserPresent($this->organization_id, $value);
                    if($is_present) $fail('The user already exists in the organization.');
                }
            ],
            'organization_id' => 'required|integer|exists:organizations,id',
            'role' => 'required|in:member,admin',
        ];
    }


    /**
     * Error message
     * @return array
     */
    public function messages(): array {
        return [
            'user_id.required' => 'User id is required',
            'user_id.integer' => 'User ID must be an integer.',
            'user_id.unique' => 'User ID must be unique.',
            'organization_id.integer' => 'Organization ID must be an integer.',
            'organization_id.required' => 'Organization ID is required.',
            'role.required' => 'Role field is required.',
            'role.in' => 'Role must be a valid role.',


        ];
    }
}
