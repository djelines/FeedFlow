<?php
namespace App\Actions\Survey;

use App\DTOs\SurveyQuestionDTO;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\DB;
use App\Models\SurveyQuestion;

final class DeleteSurveyQuestionAction
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

    public function execute(SurveyQuestionDTO $dto , SurveyQuestion $question): void
    {
        $question->delete();
    }
}
