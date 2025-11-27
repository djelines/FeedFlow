<?php

namespace App\Http\Controllers;

use App\Actions\Organization\DeleteMemberAction;
use App\Actions\Organization\StoreMemberAction;
use App\DTOs\MemberDTO;
use App\Http\Requests\Organization\DeleteMemberRequest;
use App\Http\Requests\Organization\StoreMemberRequest;
use App\Models\Organization;
use App\Models\OrganizationUser;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use \Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class MemberController
{
    use AuthorizesRequests;
    /**
     * Store a newly created member
     * @param StoreMemberRequest $request
     * @param StoreMemberAction $action
     * @return RedirectResponse
     */
    public function store(StoreMemberRequest $request, StoreMemberAction $action): RedirectResponse
    {
        Gate::forUser(auth()->user())->authorize('createMember', Organization::find($request->organization_id));
        $dto = MemberDTO::fromRequest($request);

        $member = $action->execute($dto);

        return redirect()->back()->with('success', 'Membre ajouté avec succès !');
    }

    /**
     * Delete a member
     * @param DeleteMemberRequest $request
     * @param DeleteMemberAction $action
     * @return RedirectResponse
     */
    public function delete(DeleteMemberRequest $request, DeleteMemberAction $action, $hash_id): RedirectResponse
    {
        $organizationUser = OrganizationUser::findByHashOrFail($hash_id);
        $organization = Organization::find($organizationUser->organization_id);
        $organization = Organization::findByHashOrFail($organization->hash_id);
        $target = User::findOrFail($organizationUser->user_id);
        Gate::forUser(auth()->user())->authorize('deleteMember', [$organization, $target]);
        $dto = new \App\DTOs\MemberDTO(
            organization_id: $organization->id,
            user_id: $target->id,
            role: $organizationUser->role,
            created_at: $organizationUser->created_at,
            updated_at: $organizationUser->updated_at,
        );
        $member = $action->execute($dto, $organizationUser);

        return redirect()->back()->with('success', 'Membre retiré avec succès !');
    }
}
