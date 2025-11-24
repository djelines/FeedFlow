<?php

namespace App\Http\Requests\Organization;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class DeleteMemberRequest extends FormRequest
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
    public static function rules(): array {
        return [];
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
        return [];
    }
}
