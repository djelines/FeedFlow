<?php

namespace App\Http\Controllers;

use App\Actions\Survey\StoreSurveyAction;
use App\DTOs\SurveyDTO;
use App\Http\Requests\Survey\StoreSurveyRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Models\Survey;
use App\Actions\Survey\DeleteSurveyAction;


class SurveyController extends Controller
{

    //function to create a survey
    public function store(StoreSurveyRequest $request , StoreSurveyAction $action) {

        //Create DTO
        $dto = SurveyDTO::fromRequest($request);

        //Execute the Action of StoreSurveyAction (Store in DB)
        $survey = $action -> execute($dto);

        //Return succesfull Json
        return redirect()->route('survey.view');
    }


    //function to edit a survey  
    public function editSurvey(){

    }   

    //function to destroy a survey 
    public function destroySurvey(Request $request, Survey $survey, DeleteSurveyAction $action){
        //delete survey in database
        $deleteSurvey = $action -> delete($survey);
        return redirect()->route('survey.view');
    }

    //function to fetch a survey
    public function index(){
        //fetch all survey in database
        $surveys = Survey::all();

        return view('surveys.survey',compact('surveys'));
    }
} 
