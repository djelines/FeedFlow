<?php
namespace App\Actions\Organization;

use App\DTOs\OrganizationDTO;
use Illuminate\Support\Facades\DB;
use App\Models\Organization;

final class DeleteOrganizationAction
{
    public function __construct() {}

    /**
     * Delete an organization
     * @param OrganizationDTO $dto
     * @return Organization
     */
    public function execute(OrganizationDTO $dto, Organization $organization)
    {
        $organization->delete();

        return $organization;
    }


}
