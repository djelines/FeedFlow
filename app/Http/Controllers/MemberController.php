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
    public function delete(DeleteMemberRequest $request, DeleteMemberAction $action, OrganizationUser $organization_member): RedirectResponse
    {
        $organization = Organization::findOrFail($organization_member->organization_id);
        $target = User::findOrFail($organization_member->user_id);

        Gate::forUser(auth()->user())->authorize('deleteMember', [$organization, $target]);

        $dto = MemberDTO::fromRequest($request);
        $member = $action->execute($dto, $organization_member);

        return redirect()->back()->with('success', 'Membre retiré avec succès !');
    }
}
