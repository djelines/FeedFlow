<?php

namespace App\Http\Requests\Survey;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use League\CommonMark\Extension\DescriptionList\Node\Description;

class StoreSurveyQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    /**
     * Transform the 'options' input into an array if it's a comma-separated string.
     */
    protected function prepareForValidation(): void
    {
        if ($this->options && is_string($this->options)) {
            $this->merge([
                'options' => array_map('trim', explode(',', $this->options))
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'survey_id' => 'nullable|integer|exists:surveys,id',
            'title' => 'nullable|string|max:255',
            'question_type' => 'nullable|string|in:text,multiple_choice,checkbox,range',
            'options' => 'nullable|array',
        ];
    }
}
