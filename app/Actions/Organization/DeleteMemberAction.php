<?php

namespace App\Actions\Organization;

use App\DTOs\MemberDTO;
use App\Models\OrganizationUser;

class DeleteMemberAction
{
    public function __construct(){}

    /**
     * Delete a member
     * @param MemberDTO $dto
     * @return mixed
     */
    public function execute(MemberDTO $dto, OrganizationUser $organization_member){

        $organization_member->delete();
        return $organization_member;
    }
}
