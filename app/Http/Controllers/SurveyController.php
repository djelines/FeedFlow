<?php

namespace App\Http\Controllers;

use App\Actions\Survey\StoreSurveyAction;
use App\Actions\Survey\StoreSurveyAnswerAction;
use App\DTOs\SurveyAnswerDTO;
use App\DTOs\SurveyDTO;
use App\Http\Requests\Survey\StoreSurveyAnswerRequest;
use App\Http\Requests\Survey\StoreSurveyRequest;
use App\Models\SurveyAnswer;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Actions\Survey\StoreSurveyQuestionAction;
use App\DTOs\SurveyQuestionDTO;
use App\Http\Requests\Survey\StoreSurveyQuestionRequest;
use App\Models\Survey;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use App\Models\SurveyQuestion;
use App\Actions\Survey\DeleteSurveyQuestionAction;

class SurveyController extends Controller
{
    use AuthorizesRequests;
    // Display the specified survey
    public function showSurvey($id)
    {
        $survey = Survey::find($id);
        return view('surveys.showSurvey', ['survey' => $survey]);
    }
    public function store(StoreSurveyRequest $request, StoreSurveyAction $action): JsonResponse
    {
        //Create DTO
        $dto = SurveyDTO::fromRequest($request);

        //Execute the Action of StoreSurveyAction (Store in DB)
        $survey = $action->execute($dto);

        //Return succesfull Json
        return response()->json([
            'messages' => 'Sondage crée avec succès !',
            'data' => $survey,
        ], 201);
    }

    // Store a new question for a survey
    public function storeQuestion(StoreSurveyQuestionRequest $request, StoreSurveyQuestionAction $action): RedirectResponse
    {
        //Create DTO
        $this->authorize('createQuestion', arguments:  [Survey::find($request->survey_id)]);

        $dto = SurveyQuestionDTO::fromRequest($request);
        $action->execute($dto);
        return redirect()->back()->with('success', 'Question ajoutée avec succès !');
    }
    // Delete a question from a survey
    public function destroyQuestion(StoreSurveyQuestionRequest $request , DeleteSurveyQuestionAction $action , SurveyQuestion $question): RedirectResponse
    {
        $this->authorize('deleteQuestion', arguments:  [Survey::find($question->survey_id)]);
        $dto = SurveyQuestionDTO::fromRequest($request);
        $action->execute($dto, $question);
        return redirect()->back()->with('success', 'Question supprimée avec succès !');
    }

    //function to edit a survey
    public function editSurvey()
    {

    }

    //function to destroy a survey
    public function destroySurvey($id)
    {

    }

    public function view()
    {
        $surveys = Survey::all();

        return view('surveys.survey', compact('surveys'));
    }


    public function viewQuestions($id){
        $survey = Survey::find($id);
        $surveyQuestions = $survey->questions;

        return view('surveys.answer.survey', [
            'surveyQuestions' => $surveyQuestions,
            'survey_id' => $id
        ]);
    }

    public function storeAnswers(StoreSurveyAnswerRequest $request, StoreSurveyAnswerAction $action){

        $dto = SurveyAnswerDTO::fromRequest($request);

        $surveyAnswers = $action->execute($dto);

        return redirect("/dashboard");

    }
}
