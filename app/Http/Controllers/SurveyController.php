<?php

namespace App\Http\Controllers;

use App\Actions\Survey\StoreSurveyAction;
use App\DTOs\SurveyDTO;
use App\Http\Requests\Survey\StoreSurveyRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Models\Survey;

class SurveyController extends Controller
{

    //function to create a survey
    public function store(StoreSurveyRequest $request , StoreSurveyAction $action): JsonResponse{

        //Create DTO
        $dto = SurveyDTO::fromRequest($request);

        //Execute the Action of StoreSurveyAction (Store in DB)
        $survey = $action -> execute($dto);

        //Return succesfull Json
        return response()->json([
            'messages' => 'Sondage crée avec succès !',
            'data' => $survey,
        ], 201 );
    }


    //function to edit a survey  
    public function editSurvey(){

    }

    //function to destroy a survey 
    public function destroySurvey($id){
        
    }

    public function view(){
        $surveys = Survey::all();

        return view('surveys.survey',compact('surveys'));
    }
} 
