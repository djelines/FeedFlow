<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Actions\Survey\GetSurveyResultsAction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SurveyResultsController extends Controller
{
    use AuthorizesRequests;
    /**
     * @param Survey $survey
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * Show all the question and answer for statistics
     */
    public function viewResults($hash_id)
    {
        $survey = Survey::findByHashOrFail($hash_id);
        $this->authorize('view', $survey);

        // All survey questions and answers are loaded at the same time.
        $survey->load('questions.answers');

        return view('surveys.answer.results', compact('survey'));
    }

    /**
     * @param Survey $survey
     * @return \Illuminate\Http\Response
     * Possibility of download pdf statistics
     */
    public function downloadPdf($hash_id){
        $survey = Survey::findByHashOrFail($hash_id);
        $survey->load('questions.answers');

        $pdf = Pdf::loadView('surveys.answer.resultPdf', compact('survey'));

        return $pdf->download('results.pdf');
    }

}
