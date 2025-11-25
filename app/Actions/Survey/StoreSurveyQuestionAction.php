<?php
namespace App\Actions\Survey;

use App\DTOs\SurveyQuestionDTO;
use Illuminate\Support\Facades\DB;
use App\Models\SurveyQuestion;

final class StoreSurveyQuestionAction
{
    public function __construct() {}

    /**
     * Store a Survey
     * @param SurveyQuestionDTO $dto
     * @return array
     */
    public function handle(SurveyQuestionDTO $dto): array
    {
        return DB::transaction(function () use ($dto) {
        });
    }

    public function execute(SurveyQuestionDTO $dto): SurveyQuestion
    {
        return SurveyQuestion::create([
            'survey_id'    => $dto->survey_id,
            'title' => $dto->title,
            'question_type' => $dto->question_type,
            'options' => $dto->options,
            'created_at' => $dto->created_at,
            'updated_at' => $dto->updated_at,
        ]);
    }
}
