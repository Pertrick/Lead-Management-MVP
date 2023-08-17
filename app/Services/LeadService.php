<?php

namespace App\Services;

use App\Models\Lead;
use Illuminate\Pagination\LengthAwarePaginator;

class LeadService
{
    /**
     * Fetch all Leads and also filter based on status and user_id
     *
     */
    public function getLeads() : LengthAwarePaginator 
    {
       return Lead::with('owner')
            ->when(request()->filled('status'),fn($q) => $q->where('status', request()->status))
            ->when(request()->filled('owner'), fn($q) => $q->where('user_id',request()->owner))
            ->latest()
            ->paginate();
    }

}
