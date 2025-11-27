<?php

namespace App\Listeners;

use App\Events\DailyAnswersThresholdReached;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\DailyReportSurvey;

class SendDailyReport
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(DailyAnswersThresholdReached $event): void
    {
        Mail::to($event->ownerEmail)->send(new DailyReportSurvey($event->surveyName, $event->surveyAnswersCount , $event->userName));
    }
}
