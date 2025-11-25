<?php

namespace App\DTOs;

class GetSurveyResultsDTO
{
    public function __construct(
        public array $questions,
        public array $chart1,
        public array $chart2,
        public int   $totalResponses
    ) {}
}
