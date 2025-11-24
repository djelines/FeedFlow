<?php
namespace App\Actions\Survey;

use App\DTOs\SurveyDTO;
use App\Models\Survey;
use Illuminate\Support\Facades\DB;

final class StoreSurveyAction
{
    public function __construct() {}

    /**
     * Store a Survey in DB
     * @param SurveyDTO $dto
     * @return array
     */
    public function execute(SurveyDTO $dto): Survey
    {
        $survey = Survey::create([
            'title'           => $dto->title,
            'description'     => $dto->description,
            'user_id'         => $dto->user_id,
            'is_anonymous'    => $dto->is_anonymous,
            'organization_id' => $dto->organization_id,
            'start_date'      => $dto->start_date,
            'end_date'        => $dto->end_date,
            
        ]);

        return $survey;
    }
}
