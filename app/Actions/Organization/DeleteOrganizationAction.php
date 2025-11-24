<?php
namespace App\Actions\Organization;

use App\DTOs\OrganizationDTO;
use Illuminate\Support\Facades\DB;

final class DeleteOrganizationAction
{
    public function __construct() {}

    /**
     * Delete an organization
     * @param OrganizationDTO $dto
     * @return array
     */
    public function execute(OrganizationDTO $dto)
    {
        $organization = Organization::find($dto->id);

        dd($organization);

        if($organization->delete()){
            return "J'ai supprimé";
        } else{
            return "J'ai pas supprimé";
        }
    }


}
