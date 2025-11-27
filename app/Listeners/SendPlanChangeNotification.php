<?php

namespace App\Listeners;

use App\Events\PlanChanged;
use App\Mail\PlanChangedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPlanChangeNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event (don't forget the queue)
     * @param PlanChanged $event
     * @return void
     */
    public function handle(PlanChanged $event): void
    {
        Mail::to($event->ownerEmail)->send(
            new PlanChangedMail(
                $event->organization,
                $event->oldPlan,
                $event->newPlan
            )
        );
    }
}
