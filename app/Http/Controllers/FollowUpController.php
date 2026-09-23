<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FollowUp;
use App\Models\Lead;

class FollowUpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $followUps = FollowUp::with('lead')
                               ->latest()
                               ->get();

        return response()->json($followUps);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'follow_up_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $validated['created_by'] = auth()->id();

        $followUp = FollowUp::create($validated);

        return response()->json([
            'message' => 'FollowUp created Successfully.',
            'follow_up' =>$followUp
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(FollowUp $followUp)
    {
        $followUp->load('lead');

        return response()->json($followUp);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FollowUp $followUp)
    {
        $validated = $request->validate([
            'lead_id' => 'required|exists:leads,id',
        'follow_up_date' => 'required|date',
        'notes' => 'nullable|string',
        ]); 

        $followUp->update($validated);

        return response()->json([
            'message' => "FollowUp updated Successfully",
            'follow_up' => $followUp,
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FollowUp $followUp)
    {
        $followUp->delete();

        return response()->json([
            'message' => 'FollowUp updated Successfully',
        ]);
    }

    public function upcoming(){
        $followUps = Lead::whereDate('follow_up_date', '>=', now())
                         ->with('assignedSalesperson')
                         ->orderBy('follow-up_date')
                         ->get();

        return response()->json($followUps);
    }

    public function overdue(){
        $followUps = Lead::whereDate('follow_up_date', '<',now())
                         ->with('assignedSalesperson')
                         ->orderBy('follow_up_date')
                         ->get();
        return response()->json($followUps);                      
    }
}
