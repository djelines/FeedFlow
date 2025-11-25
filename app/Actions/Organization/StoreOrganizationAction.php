<?php
namespace App\Actions\Organization;

use App\DTOs\OrganizationDTO;
use Illuminate\Support\Facades\DB;
use App\Models\Organization;

final class StoreOrganizationAction
{
    public function __construct() {}

    /**
     * Store an organization
     * @param OrganizationDTO $dto
     * @return array
     */
    public function handle(OrganizationDTO $dto): array
    {
        return DB::transaction(function () use ($dto) {
        });
    }

    /**
     * @param OrganizationDTO $dto
     * @return Organization
     */
    public function execute(OrganizationDTO $dto) : Organization {
        $organization = Organization::create([
            'name'    => $dto->name,
            'user_id' => $dto->user_id,
            'created_at' => $dto->created_at,
            'updated_at' => $dto->updated_at,
        ]);

        return $organization;
    }


}
