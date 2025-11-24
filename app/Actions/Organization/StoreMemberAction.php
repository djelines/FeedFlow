<?php

namespace App\Actions\Organization;

use App\DTOs\MemberDTO;
use App\Models\OrganizationUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StoreMemberAction
{

    public function __construct() {}

    /**
     * Store a member
     * @param MemberDTO $dto
     * @return array
     */
    public function handle(MemberDTO $dto): array
    {
        return DB::transaction(function () use ($dto) {
        });
    }

    public function execute(MemberDTO $dto): OrganizationUser
    {

        $member = OrganizationUser::create(
            [
                'organization_id' => $dto->organization_id,
                'user_id' => $dto->user_id,
                'role' => $dto->role,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );

        return $member;

    }



}
