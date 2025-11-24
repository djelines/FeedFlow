<?php

namespace App\Http\Requests\Organization;

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
     * Rules validation
     * @return array
     */
    public function rules(): array {
        return [
            'user_id' => [
                'integer',
                'unique:organization_users,user_id,' .
                'NULL,id,' .
                'organization_id,' . $this -> input('organization_id')
            ],
            'organization_id' => 'required|integer|exists:organizations,id',
            'role' => 'required|in:member,admin',
            'email' => 'required|string|email|max:255|exists:users,email',
        ];
    }

    public function getUserIdByEmail(): ?int
    {
        return User::where('email', $this->input('email'))->value('id');
    }

    /**
     * Error message
     * @return array
     */
    public function messages(): array {
        return [

            'user_id.integer' => 'User ID must be an integer.',
            'user_id.unique' => 'User ID must be unique.',
            'organization_id.integer' => 'Organization ID must be an integer.',
            'organization_id.required' => 'Organization ID is required.',
            'role.required' => 'Role field is required.',
            'role.in' => 'Role must be a valid role.',
            'email.string' => 'Email must be a string.',
            'email.email' => 'Email must be a valid email.',
            'email.required' => 'Email is required.',
            'email.exists' => 'Email is invalid.',


        ];
    }
}
