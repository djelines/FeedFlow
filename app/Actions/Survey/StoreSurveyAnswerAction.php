<?php
namespace App\Actions\Survey;

use App\DTOs\SurveyAnswerDTO;
use App\DTOs\SurveyDTO;
use App\Models\Survey;
use App\Models\SurveyAnswer;
use App\Models\User;
use App\Events\SurveyAnswerSubmitted;
use Illuminate\Support\Facades\DB;

final class StoreSurveyAnswerAction
{
    public function __construct() {}

    /**
     * Store a Survey Answer
     * @param SurveyAnswerDTO $dto
     * @return array
     */
    public function execute(SurveyAnswerDTO $dto): array
    {
        if($dto->answers){

            $allSurveyAnswers = [];
            $user_id_final = Survey::find($dto->survey_id)->is_anonymous ? null : $dto->user_id;

            foreach ($dto->answers as $answer) {
                $answerData = $answer['response'] ?? null;

                $encodedAnswer = is_array($answerData) ? json_encode($answerData) : $answerData;

                $surveyAnswer = SurveyAnswer::create([
                    'survey_id' => $dto->survey_id,
                    'survey_question_id' => $answer['question_id'],
                    'user_id' => $user_id_final,
                    'answer' => $encodedAnswer ?? "",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                $allSurveyAnswers[] = $surveyAnswer;
            }

             $survey = Survey::find($dto->survey_id);


             $OwnerEmail = User::find($survey->user_id)->email;
             $userName = User::find($survey->user_id)->last_name . " " . User::find($survey->user_id)->first_name;
        

             try {
                if(User::find($survey->user_id)->mailNotificationsEnabled()){
                    event(new SurveyAnswerSubmitted($survey , $OwnerEmail,$userName));
                }
             } catch (\Exception $e) {
                 \Log::error('Failed to dispatch SurveyAnswerSubmitted event: ' . $e->getMessage());
             }

            return $allSurveyAnswers;
        }

        return [];

    }
}
