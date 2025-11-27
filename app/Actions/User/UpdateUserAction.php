<?php
namespace App\Actions\User;

use App\DTOs\OrganizationDTO;
use Illuminate\Support\Facades\DB;
use App\Models\Organization;
use App\Models\User;
use App\DTOs\UserDTO;

final class UpdateUserAction
{
    public function __construct() {}

    /**
     * Update mail_notifications for disable/enable
     * @param UserDTO $dto
     * @return array
     */
    public function execute(UserDTO $dto, User $user)
    {
        $user->update([
            'mail_notifications' => $dto->mail_notifications
        ]);
    }


}