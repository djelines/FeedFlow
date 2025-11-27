<?php

namespace App\Events;

use App\Models\Organization;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PlanChanged
{
    use Dispatchable, SerializesModels;

    public Organization $organization;
    public string $oldPlan;
    public string $newPlan;
    public string $ownerEmail;

    /**
     * Create a new event instance.
     * @param Organization $organization
     * @param string $oldPlan
     * @param string $newPlan
     * @param string $ownerEmail
     */
    public function __construct(Organization $organization, string $oldPlan, string $newPlan, string $ownerEmail)
    {
        $this->organization = $organization;
        $this->oldPlan = $oldPlan;
        $this->newPlan = $newPlan;
        $this->ownerEmail = $ownerEmail;
    }
}
