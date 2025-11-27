<?php

namespace App\Console\Commands;

use App\Events\DailyAnswersThresholdReached;
use Illuminate\Console\Command;
use App\Models\Survey;
use Illuminate\Support\Facades\Log;
use App\Models\User;
class SendSurveyDailyReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-survey-daily-reports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    /**
     * Execute the console command.
     * Send an email when answer is > 10 every last 24h
     */
    public function handle()
    {
        $allSurveys = Survey::all();

        foreach ($allSurveys as $survey) {

            $surveyAnswersCount = $survey->answers()->where('created_at', '>=', now()->subDay())->count();
            $surveyName = $survey->title;
            $userName = User::find($survey->user_id)->last_name . " " . User::find($survey->user_id)->first_name;
            
            if ($surveyAnswersCount > 0) {
                $this->info("ici");
                $ownerEmail = User::find($survey->user_id)->email;
                if(User::find($survey->user_id)->mailNotificationsEnabled()){
                    event(new DailyAnswersThresholdReached( $ownerEmail ,$surveyName, $surveyAnswersCount ,$userName));
                }
            }

        }
    }
}
