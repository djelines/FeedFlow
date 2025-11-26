<?php
namespace App\Actions\Organization;

use App\DTOs\OrganizationDTO;
use App\Models\Organization;
use Illuminate\Support\Facades\DB;

final class UpdateOrganizationAction
{
    public function __construct() {}

    /**
     * Update an organization
     * @param OrganizationDTO $dto
     * @return array
     */
    public function execute(OrganizationDTO $dto, Organization $organization) : Organization {

        $attributes = [
            'name'       => $dto->name,
            'plan'       => $dto->plan,
            'updated_at' => $dto->updated_at,
        ];

        $dataToUpdate = array_filter($attributes, fn($value) => !is_null($value));

        if ($organization->exists && !empty($dataToUpdate)) {
            $organization->update($dataToUpdate);
        }

        return $organization;
    }
}
