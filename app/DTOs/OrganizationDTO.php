<?php

namespace App\DTOs;

use Illuminate\Http\Request;
use App\Http\Requests\Organization\StoreOrganization;

final class OrganizationDTO
{
    private function __construct(
        public readonly ?string $name,
        public readonly ?int $user_id,
        public readonly ?string $created_at,
        public readonly ?string $updated_at,
    ) {}

    public static function fromRequest(StoreOrganization $request): self
    {
        // Create a new OrganizationDTO from the request data
        return new self(
            name: $request->name,
            user_id: $request->user()->id,
            created_at: date('Y-m-d H:i:s'),
            updated_at: $request->updated_at,
        );
    }
}
