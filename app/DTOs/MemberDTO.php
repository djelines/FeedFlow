<?php

namespace App\DTOs;

use App\Actions\Organization\DeleteMemberAction;
use App\Http\Requests\Organization\DeleteMemberRequest;
use App\Http\Requests\Organization\StoreMemberRequest;
use App\Models\User;


class MemberDTO
{

    public function __construct(
        public readonly ?int $user_id,
        public readonly ?int $organization_id,
        public readonly string $role,
        public readonly string $created_at,
        public readonly string $updated_at,
    ){}


    /**
     * Create a new MemberDTO from the request data
     * @param StoreMemberRequest|DeleteMemberRequest $request
     * @return self
     */
    public static function fromRequest(StoreMemberRequest|DeleteMemberRequest $request): self
    {
        return new self(
            user_id: $request->user_id
            ?? $request->getUserIdByEmail() ,
            organization_id: $request->organization_id,
            role: $request->role ?? 'member',
            created_at: date('Y-m-d H:i:s'),
            updated_at: $request->updated_at ?? date('Y-m-d H:i:s'),
        );
    }


}
