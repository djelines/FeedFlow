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

        if($organization){
            $organization->update([
                'name'    => $dto->name,
                'updated_at' => $dto->updated_at,
            ]);
        }


        return $organization;
    }
}
