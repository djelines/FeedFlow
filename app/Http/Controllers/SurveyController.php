<?php

namespace App\Http\Controllers;

use App\Actions\Survey\StoreSurveyAction;
use App\DTOs\SurveyDTO;
use App\Http\Requests\Survey\StoreSurveyRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Actions\Survey\StoreSurveyQuestionAction;
use App\DTOs\SurveyQuestionDTO;
use App\Http\Requests\Survey\StoreSurveyQuestionRequest;
use App\Models\Survey;

class SurveyController extends Controller
{
    // Display the specified survey
    public function showSurvey($id){
        $survey = Survey::find($id);
        return view('survey.showSurvey', ['survey' => $survey]);
    }
    public function store(StoreSurveyRequest $request , StoreSurveyAction $action): JsonResponse{
        //Create DTO
        $dto = SurveyDTO::fromRequest($request);

        //Execute the Action of StoreSurveyAction (Store in DB)
        $survey = $action -> execute($dto);

        //Return succesfull Json
        return response()->json([
            'messages' => 'Sondage crée avec succès ! <3',
            'data' => $survey,
        ], 201 );
    }

    // Store a new question for a survey
    public function storeQuestion(StoreSurveyQuestionRequest $request , StoreSurveyQuestionAction $action): RedirectResponse{
        //Create DTO
        $dto = SurveyQuestionDTO::fromRequest($request);
        $action -> execute($dto);
        return redirect()->back()->with('success', 'Question ajoutée avec succès !');
    }



}
