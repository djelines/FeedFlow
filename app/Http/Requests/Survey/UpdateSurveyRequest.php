<?php

namespace App\Http\Requests\Survey;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSurveyRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'start_date' => ['nullable',  Rule::date()],
            'end_date' => ['nullable', Rule::date()],
            'is_anonymous' => ['nullable', 'boolean'],
        ];
    }

    public function messages():array{
        return[
            'title'           => 'Le Titre est obligatoire.',
            'description'           => 'Le Titre est obligatoire.',
            'start_date'           => 'Le Titre est obligatoire.',
            'end_date'           => 'Le Titre est obligatoire.',
            'is_anonymous'           => 'Le Titre est obligatoire.',
        ];
    }

}
