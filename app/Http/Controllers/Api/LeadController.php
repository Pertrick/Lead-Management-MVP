<?php

namespace App\Http\Controllers\Api;

use App\Models\Lead;
use Illuminate\Http\Request;
use App\Services\LeadService;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Lead\StoreRequest;
use App\Http\Requests\Api\Lead\DeleteRequest;
use App\Http\Requests\Api\Lead\UpdateRequest;
use App\Http\Resources\Api\Lead\LeadResource;
use Illuminate\Http\Resources\Json\ResourceCollection;


class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LeadService $leadService)
    {
        $leads = $leadService->getLeads();
        return new ResourceCollection($leads);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $lead = auth()->user()->leads()->create($request->validated());
        return new LeadResource($lead->load('owner'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
        $this->authorize('lead-user-permission', $lead);
        return new LeadResource($lead->load('owner'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Lead $lead)
    {
        $this->authorize('lead-user-permission', $lead);
        $lead->update($request->validated());

        return new LeadResource($lead);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead): JsonResponse|Response
    {
        $this->authorize('lead-user-permission', $lead);

        if ($lead->delete()) {
            return response()->noContent();
        }

        return response()->json(['message' => 'Unable to delete lead', 400]);
    }
}
