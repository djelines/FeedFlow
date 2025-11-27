<?php
namespace App\Actions\Organization;

use App\DTOs\OrganizationDTO;
use App\Events\PlanChanged;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\DB;

final class UpdateOrganizationAction
{
    public function __construct() {}

    /**
     * Update an organization
     * @param OrganizationDTO $dto
     * @return array
     */
    public function handle(OrganizationDTO $dto): array
    {
        return DB::transaction(function () use ($dto) {
        });
    }

    /**
     * Update an organization
     * @param OrganizationDTO $dto
     * @param Organization $organization
     * @return Organization
     */
    public function execute(OrganizationDTO $dto, Organization $organization) : Organization {

        $oldPlan = $organization->plan;

        $attributes = [
            'name'       => $dto->name,
            'plan'       => $dto->plan,
            'updated_at' => $dto->updated_at,
        ];

        $dataToUpdate = array_filter($attributes, fn($value) => !is_null($value));

        if ($organization->exists && !empty($dataToUpdate)) {

            $organization->update($dataToUpdate);

            if ($dto->plan && $dto->plan !== $oldPlan) {

                $ownerEmail = User::find($organization->user_id)->email;

                // Call event to change Plan and Email
                if(User::find($organization->user_id)->mailNotificationsEnabled()){
                    event(new PlanChanged(
                        $organization,
                        $oldPlan,
                        $dto->plan,
                        $ownerEmail
                    ));
                }
            }
        }

        return $organization;
    }
}
