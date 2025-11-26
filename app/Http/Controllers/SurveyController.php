<?php

namespace App\Http\Controllers;

use App\Actions\Survey\StoreSurveyAction;
use App\DTOs\SurveyDTO;
use App\Http\Requests\Survey\StoreSurveyRequest;
use App\Http\Requests\Survey\UpdateSurveyRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Models\Survey;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use App\Models\SurveyQuestion;
use App\Actions\Survey\DeleteSurveyQuestionAction;
use App\Actions\Survey\UpdateSurveyQuestionAction;
use App\Actions\Survey\DeleteSurveyAction;
use App\Actions\Survey\UpdateSurveyAction;
use App\DTOs\SurveyQuestionDTO;
use App\Http\Requests\Survey\StoreSurveyQuestionRequest;
use Illuminate\Http\RedirectResponse;
use App\Actions\Survey\StoreSurveyQuestionAction;


class SurveyController extends Controller
{
    use AuthorizesRequests;
    // Display the specified survey
    public function showSurvey($id)
    {
        $survey = Survey::find($id);
        return view('surveys.showSurvey', ['survey' => $survey]);
    }
    public function store(StoreSurveyRequest $request, StoreSurveyAction $action)
    {
        //Create DTO
        $dto = SurveyDTO::fromRequest($request);

        //Execute the Action of StoreSurveyAction (Store in DB)
        $survey = $action -> execute($dto);

        return redirect()->back()->with('success', 'Sondage créé avec succès !');
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
    public function updateQuestion(StoreSurveyQuestionRequest $request , UpdateSurveyQuestionAction $action , SurveyQuestion $question): RedirectResponse
    {   
        $this->authorize('editQuestion', arguments:  [Survey::find($question->survey_id)]);
        $dto = SurveyQuestionDTO::fromRequest($request);
        $action->execute($dto, $question);
        return redirect()->back()->with('success', 'Question modifiée avec succès !');
    }

    //function to edit a survey  
    public function updateSurvey(UpdateSurveyRequest $request , UpdateSurveyAction $action , Survey $survey ){
        $this->authorize('update',arguments:[Survey::find($survey->user_id)]);
        $dto = SurveyDTO::fromRequest($request);
        $action->update($dto, $survey);
        return redirect()->back()->with("success","Sondage modifié avec succès !");
    }   

    //function to destroy a survey 
    public function destroySurvey(Request $request, Survey $survey, DeleteSurveyAction $action): RedirectResponse{
        //delete survey in database
        $this->authorize('delete',arguments:[Survey::find($survey->user_id)]);
        $deleteSurvey = $action -> delete($survey);
        return redirect()->back()->with('success', 'Sondage supprimé avec succès !');
    }

    //function to fetch a survey
    public function index(){
        //fetch all survey in database
        $surveys = Survey::all();

        return view('surveys.survey',compact('surveys'));
    }
} 
