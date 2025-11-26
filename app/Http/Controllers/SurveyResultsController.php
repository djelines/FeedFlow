<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Actions\Survey\GetSurveyResultsAction;

class SurveyResultsController extends Controller
{
    public function viewResults(Survey $survey)
    {

        // All survey questions and answers are loaded at the same time.
        $survey->load('questions.answers');

        return view('surveys.answer.results', compact('survey'));
    }
}
