<?php

namespace App\Http\Controllers;

use App\Actions\Survey\StoreSurveyAction;
use App\DTOs\SurveyDTO;
use App\Http\Requests\Survey\StoreSurveyRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class SurveyController extends Controller
{
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

    public function view(){
        return view('surveys.survey');
    }
}
