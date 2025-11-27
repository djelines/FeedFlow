<?php

namespace App\Listeners;

use App\Mail\FinalReportOnClose;
use App\Models\Survey;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Events\SurveyClosed;

class SendFinalReportOnClose
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
    public function handle(SurveyClosed $event): void
    {
        Mail::to($event->ownerEmail)->send(new FinalReportOnClose($event->survey, $event->surveyAnswersCount, $event->userName));
    }
}
