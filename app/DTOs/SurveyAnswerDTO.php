<?php

namespace App\DTOs;

use App\Http\Requests\Survey\StoreSurveyAnswerRequest;
use Illuminate\Http\Request;

final class SurveyAnswerDTO
{
    private function __construct(
        public readonly array $answers,
        public readonly int $survey_id,
        public readonly int $user_id,
    ) {
    }

    public static function fromRequest(StoreSurveyAnswerRequest $request): self
    {
        return new self(
            answers: $request->answers,
            survey_id: $request->survey_id,
            user_id: $request->user()->id
        );
    }
}
