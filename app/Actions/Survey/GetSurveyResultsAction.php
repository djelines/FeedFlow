<?php

namespace App\Actions\Survey;

use App\DTOs\GetSurveyResultsDTO;
use App\Models\Survey;


class GetSurveyResultsAction
{
    /**
     * Retreive all the questions and their answer to get statistics
     * @param Survey $survey
     * @return GetSurveyResultsDTO
     */
    public function handle(Survey $survey): GetSurveyResultsDTO
    {
        // Get all questions with their answers and count total responses
        $questions = $survey->questions()
            ->with('answers')
            ->get();

        $totalResponses = $survey->answers()->count();

        // Prepare chart data: number of answers per question
        $chart1Labels = [];
        $chart1Data   = [];

        foreach ($questions as $question) {
            $chart1Labels[] = $question->title;
            $chart1Data[]   = $question->answers->count();
        }

        // Prepare chart data: percentage of answers per question
        $chart2Labels = $chart1Labels;
        $chart2Data   = [];

        foreach ($questions as $question) {
            $chart2Data[] = $totalResponses > 0
                ? round(($question->answers->count() / $totalResponses) * 100, 2)
                : 0;
        }

        // Return a DTO with all data ready for display
        return new GetSurveyResultsDTO(
            questions: $questions->toArray(),
            chart1: [
                'labels' => $chart1Labels,
                'data'   => $chart1Data,
            ],
            chart2: [
                'labels' => $chart2Labels,
                'data'   => $chart2Data,
            ],
            totalResponses: $totalResponses
        );
    }
}
