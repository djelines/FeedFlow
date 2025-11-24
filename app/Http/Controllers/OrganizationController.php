<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Organization\StoreOrganization;
use App\Http\Requests\Organization\UpdateOrganization;
use App\Http\Requests\Organization\DeleteOrganization;
use App\Actions\Organization\StoreOrganizationAction;
use App\Actions\Organization\UpdateOrganizationAction;
use App\Actions\Organization\DeleteOrganizationAction;
use App\DTOs\OrganizationDTO;
use Illuminate\Http\JsonResponse;
use App\Models\Organization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class OrganizationController extends Controller
{



    // Store a newly created organization
    public function store(StoreOrganization $request, StoreOrganizationAction $action): RedirectResponse
    {

        // Validate the request and create DTO
        $dto = OrganizationDTO::fromRequest($request);

        // Execute the action to store the organization
        $organization = $action->execute($dto);

        return redirect()->back()->with('success', 'Organisation créée avec succès !');
    }

    // Update the current organization
    public function update(UpdateOrganization $request, UpdateOrganizationAction $action){
        $dto = OrganizationDTO::fromRequest($request);

        $organization = $action->execute($dto);

        return redirect()->back()->with('success', 'Organisation modifiée avec succès !');
    }

    // Delete the current organization
    public function delete(DeleteOrganization $request, DeleteOrganizationAction $action){
        $dto = OrganizationDTO::fromRequest($request);

        $organization = $action->execute($dto);

        return redirect("/dashboard");
    }



    // Template view
    public function view(){
        $organizations = Organization::where('user_id', Auth::id())->get();

        return view('organizations.index', compact(
            'organizations'
        ));
    }

    public function viewOrganization($id){
        $organization = Organization::find($id);

        return view('organizations.viewOrganization', compact(
            'organization'
        ));
    }

}
