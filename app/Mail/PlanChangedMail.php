<?php

namespace App\Mail;

use App\Models\Organization;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PlanChangedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Organization $organization;
    public string $oldPlan;
    public string $newPlan;

    public function __construct(Organization $organization, string $oldPlan, string $newPlan)
    {
        $this->organization = $organization;
        $this->oldPlan = $oldPlan;
        $this->newPlan = $newPlan;
    }

    /**
     * Build the mail
     * @return PlanChangedMail
     */
    public function build()
    {
        return $this
            ->subject("Votre forfait a changé")
            ->view('emails.planChangedTemplate')
            ->with([
                'organization' => $this->organization,
                'oldPlan'      => $this->oldPlan,
                'newPlan'      => $this->newPlan,
            ]);
    }
}
