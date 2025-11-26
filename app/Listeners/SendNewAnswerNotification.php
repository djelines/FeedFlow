<?php

namespace App\Listeners;

use App\Events\SurveyAnswerSubmitted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewAnswerNotification;

class SendNewAnswerNotification implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(SurveyAnswerSubmitted $event): void
    {
         Mail::to($event->ownerEmail)->send(new NewAnswerNotification($event->survey));
    }
}
