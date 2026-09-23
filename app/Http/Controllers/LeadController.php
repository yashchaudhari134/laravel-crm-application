<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $leads = Lead::with(['leadSource', 'assignedSalesperson'])
                 ->latest()
                 ->get();

    return view('leads.index', compact('leads'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

        return response()->json($lead);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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

    return response()->json([
        'message' => 'Lead updated Successfully',
        'lead' => $lead
    ]);
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Lead $lead)
{
    $lead->delete();

    return response()->json([
        'message' => 'Lead deleted successfully.'
    ]);
}
}
