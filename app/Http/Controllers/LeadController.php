<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use App\Models\LeadSource;
use App\Models\User;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $query = Lead::with(['leadSource', 'assignedSalesperson']);

    // Search by lead name, company name or phone
    if ($request->search) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('lead_name', 'like', "%$search%")
              ->orWhere('company_name', 'like', "%$search%")
              ->orWhere('phone', 'like', "%$search%");
        });
    }

    // Filter by status
    if ($request->status) {
        $query->where('status', $request->status);
    }

    // Filter by lead source
    if ($request->lead_source_id) {
        $query->where('lead_source_id', $request->lead_source_id);
    }

    // Filter by assigned salesperson
    if ($request->assigned_salesperson_id) {
        $query->where('assigned_salesperson_id', $request->assigned_salesperson_id);
    }

    $leads = $query->latest()->get();

    $leadSources = LeadSource::all();
    $salespeople = User::all();

    return view('leads.index', compact(
        'leads',
        'leadSources',
        'salespeople'
    ));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $leadSources = LeadSource::all();
    $salespeople = User::all();

    return view('leads.create', compact('leadSources', 'salespeople'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lead_name' => 'required|string|max:255',
        'company_name' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'phone' => 'required|string|max:20',
        'lead_source_id' => 'required|exists:lead_sources,id',
        'status' => 'required|in:New,Contacted,Follow-up,Qualified,Proposal Sent,Won,Lost',
        'assigned_salesperson_id' => 'nullable|exists:users,id',
        'expected_deal_value' => 'required|numeric|min:0',
        'follow_up_date' => 'nullable|date',
        'notes' => 'nullable|string',
        ]); 

        Lead::create($validated);

        return redirect()
            ->route('leads.index')
            ->with('success','Lead created successfully.');
    }

    /**
     * Display the specified resource.
     */
   public function show(Lead $lead)
{
    $lead->load([
        'leadSource',
        'assignedSalesperson',
        'followUps'
    ]);

    return view('leads.show', compact('lead'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lead $lead)
    {
        $leadSources = LeadSource::all();
        $salespeople = User::all();

        return view('leads.edit',compact('lead','leadSources','salespeople'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lead $lead)
    {
        $validated = $request->validate([
        'lead_name' => 'required|string|max:255',
        'company_name' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'phone' => 'required|string|max:20',
        'lead_source_id' => 'required|exists:lead_sources,id',
        'status' => 'required|in:New,Contacted,Follow-up,Qualified,Proposal Sent,Won,Lost',
        'assigned_salesperson_id' => 'nullable|exists:users,id',
        'expected_deal_value' => 'required|numeric|min:0',
        'follow_up_date' => 'nullable|date',
        'notes' => 'nullable|string',
    ]);

    $lead->update($validated);

  return redirect()
    ->route('leads.index')
    ->with('success', 'Lead updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Lead $lead)
{
    $lead->delete();

   return redirect()
    ->route('leads.index')
    ->with('success', 'Lead deleted successfully.');
}
}
