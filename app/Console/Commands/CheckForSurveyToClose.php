<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Survey;
use App\Models\User;
use App\Events\SurveyClosed;
class CheckForSurveyToClose extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-for-survey-to-close';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $allSuveys = Survey::where('is_closed', false)->get();

        foreach ($allSuveys as $survey) {
            $closingDate = $survey->end_date;
            if ($closingDate <= now()) {
                try {
                    $survey->is_closed = true;
                    $survey->save();
                    $ownerEmail = User::find($survey->user_id)->email;
                    $userName = User::find($survey->user_id)->last_name . " " . User::find($survey->user_id)->first_name;
                    $surveyAnswerCount = $survey->answers()->count();

                    if(User::find($survey->user_id)->mailNotificationsEnabled()){
                         event(new SurveyClosed($survey,$ownerEmail, $surveyAnswerCount, $userName));
                    }
                } catch (\Exception $e) {
                    $this->error('Failed to close survey ID ' . $survey->id . ': ' . $e->getMessage());
                }
            }
        }
    }
}
