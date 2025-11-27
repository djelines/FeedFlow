<?php
namespace App\Actions\Survey;

use App\DTOs\SurveyDTO;
use Illuminate\Support\Facades\DB;
use App\Models\Survey;


final class DeleteSurveyAction
{
    public function __construct() {}

    /**
     * Actions when a Survey is delete from db
     * @param SurveyDTO $dto
     * @return array
     */
    public function delete(Survey $survey): survey
    {


        //delete survey in database
        $survey->delete();

        return $survey ;
    }
}
