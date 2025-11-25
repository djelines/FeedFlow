<?php

namespace App\DTOs;

use Illuminate\Http\Request;
use App\Http\Requests\Survey\StoreSurveyQuestionRequest;

final class SurveyQuestionDTO
{
public function __construct(
        public readonly ?int $survey_id,
        public readonly ?string $title,
        public readonly ?string $question_type,
        public readonly ?array $options,
        public readonly \DateTime $created_at,
        public readonly \DateTime $updated_at,
    ) {}
    // Create DTO from Request for validation 
    public static function fromRequest(StoreSurveyQuestionRequest $request): self
    {
        return new self(
            survey_id: $request->survey_id,
            title: $request->title,
            question_type: $request->question_type,
            options: $request->options ?? [],
            created_at: now(),
            updated_at: now(),
        );
    }
}
