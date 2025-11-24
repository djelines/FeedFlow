<?php

namespace App\Actions\Organization;

use App\DTOs\MemberDTO;
use App\Models\OrganizationUser;

class DeleteMemberAction
{
    public function __construct(){}

    public function execute(MemberDTO $dto){

        $member = OrganizationUser::find($dto->user_id);
        $member->delete();
        return $member;
    }
}
