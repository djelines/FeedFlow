<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Organization\StoreOrganization;
use App\Actions\Organization\StoreOrganizationAction;
use App\DTOs\OrganizationDTO;
use Illuminate\Http\JsonResponse;

class OrganizationController extends Controller
{

    public function view(){
        return view('organizations.index');
    }

    // Store a newly created organization
    public function store(StoreOrganization $request, StoreOrganizationAction $action): JsonResponse    {

        // Validate the request and create DTO
        $dto = OrganizationDTO::fromRequest($request);

        // Execute the action to store the organization
        $action = new StoreOrganizationAction();
        $organization = $action->execute($dto);

        return response()->json($organization, 201);
    }

}
