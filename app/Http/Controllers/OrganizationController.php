<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
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
use App\Models\Survey;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class OrganizationController extends Controller
{

    use AuthorizesRequests;

    /**
     * Store a newly created organization
     * @param StoreOrganization $request
     * @param StoreOrganizationAction $action
     * @return RedirectResponse
     */
    public function store(StoreOrganization $request, StoreOrganizationAction $action): RedirectResponse
    {

        // Validate the request and create DTO
        $dto = OrganizationDTO::fromRequest($request);

        // Execute the action to store the organization
        $organization = $action->execute($dto);

        return redirect()->back()->with('success', 'Organisation créée avec succès !');
    }

    /**
     * Update the current organization
     * @param UpdateOrganization $request
     * @param UpdateOrganizationAction $action
     * @return RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateOrganization $request, UpdateOrganizationAction $action){

        $this->authorize('update', arguments: Organization::find($request->id));
        $dto = OrganizationDTO::fromRequest($request);


        $organization = $action->execute($dto);

        return redirect()->back()->with('success', 'Organisation modifiée avec succès !');
    }

    /**
     * Delete the current organization
     * @param DeleteOrganization $request
     * @param DeleteOrganizationAction $action
     * @return RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete(DeleteOrganization $request, DeleteOrganizationAction $action){
        $this->authorize('delete', Organization::find($request->id));

        $dto = OrganizationDTO::fromRequest($request);

        $organization = $action->execute($dto);

        return redirect()->back()->with('success', 'Organisation supprimée avec succès !');
    }

    /**
     * See all organizations
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function view(){
        $organizations = Auth::user()->organizations;

        return view('organizations.index', compact(
            'organizations'
        ));
    }

    /**
     * View an unique organization
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function viewOrganization($id){
        $organization = Organization::find($id);
        $surveys = $organization->surveys;

        return view('organizations.viewOrganization', compact(
            'organization' , 'surveys'
        ));
    }

}
