<?php

namespace App\Policies;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OrganizationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Organization $organization): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function createMember(User $user , Organization $organization): bool
    {
        return $user->hasRoleInOrganization('admin', $organization);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Organization $organization): bool
    {
        return $user->hasRoleInOrganization('admin', $organization) || $user->id===$organization->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Organization $organization): bool
    {
        return $user->hasRoleInOrganization('admin', $organization) || $user->id===$organization->user_id;
    }

    /**
     * Determine whether the user can delete the model member.
     */
    public function deleteMember(User $user, Organization $organization, User $target): bool
    {
        // Only a admin can delete
        if (!$user->hasRoleInOrganization('admin', $organization)) {
            return false;
        }

        // Can't delete the proprietary
        if ($target->id === $organization->user_id) {
            return false;
        }

        // Can't delete yourself
        if ($user->id === $target->id) {
            return false;
        }

        return true;
    }




    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Organization $organization): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Organization $organization): bool
    {
        return false;
    }
}
