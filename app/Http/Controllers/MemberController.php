<?php

namespace App\Http\Controllers;

use App\Actions\Organization\DeleteMemberAction;
use App\Actions\Organization\StoreMemberAction;
use App\DTOs\MemberDTO;
use App\Http\Requests\Organization\DeleteMemberRequest;
use App\Http\Requests\Organization\StoreMemberRequest;
use Illuminate\Http\RedirectResponse;
use \Illuminate\Http\JsonResponse;
class MemberController
{
    public function store(StoreMemberRequest $request, StoreMemberAction $action): RedirectResponse
    {


        $dto = MemberDTO::fromRequest($request);

        $member = $action->execute($dto);

        return redirect()->back()->with('success', 'Membre ajouté avec succès !');
    }

    public function delete(DeleteMemberRequest $request, DeleteMemberAction $action): RedirectResponse
    {
        $dto = MemberDTO::fromRequest($request);
        $member = $action->execute($dto);
        return redirect()->back()->with('success', 'Membre retiré avec succès !');
    }

}
