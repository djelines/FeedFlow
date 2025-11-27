<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Actions\Survey\GetSurveyResultsAction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SurveyResultsController extends Controller
{
    use AuthorizesRequests;
    public function viewResults(Survey $survey)
    {

        $this->authorize('view', $survey);

        // All survey questions and answers are loaded at the same time.
        $survey->load('questions.answers');

        return view('surveys.answer.results', compact('survey'));
    }
}
