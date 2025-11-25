<?php

namespace App\Http\Requests\Survey;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use League\CommonMark\Extension\DescriptionList\Node\Description;

class StoreSurveyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        //authorize everyone
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
            'title'          => ['required', 'string','min:10'],
            'description'    => ['required', 'string','max:255'],
            'is_anonymous'   => ['required', 'boolean'],
            // 'user_id'        => ['required', 'int'],
            'organization_id'=> ['required', 'int'],
            'start_date'     => ['required', Rule::date(),],
            'end_date'       => ['required', Rule::date(),]
        ];
    }

    public function messages():array{
        return [
            // .require .min .max  = messages custom
            'title'           => 'Le Titre est obligatoire.',
            'title.min'       => 'Le Titre dois faire min 10 chars.',
            'description'     => 'Contenue obligatoire.',
            // 'user_id'         => 'User ID manquant.',
            'organization_id' => 'Organization ID manquant.'
        ];
    }
}
