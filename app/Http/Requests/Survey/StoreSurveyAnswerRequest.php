<?php

namespace App\Http\Requests\Survey;

use Illuminate\Foundation\Http\FormRequest;

class StoreSurveyAnswerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    /**
     * Transform the 'answers' input into an array if it's a comma-separated string.
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('answers') && is_string($this->answers)) {

            $decodedAnswers = json_decode($this->answers, true);

            if (is_array($decodedAnswers)) {
                $this->merge([
                    'answers' => $decodedAnswers
                ]);
            }
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
            'survey_id' => 'required|integer|exists:surveys,id',
            'answers' => 'required|array',
        ];
    }

    public function messages(): array{
        return [
            'survey_id.required' => 'Survey id is required',
            'survey_id.integer' => 'Survey id must be integer',
            'survey_id.exists' => 'Survey id is not valid',
            'answers.required' => 'Survey questions is required',
            'answers.array' => 'Survey questions must be an array',
        ];
    }
}
