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
    $today = now()->toDateString();

    $upcomingFollowUps = FollowUp::with('lead')
        ->where('follow_up_date', '>=', $today)
        ->orderBy('follow_up_date')
        ->get();

    $overdueFollowUps = FollowUp::with('lead')
        ->where('follow_up_date', '<', $today)
        ->orderBy('follow_up_date')
        ->get();

    return view('follow-ups.index', compact(
        'upcomingFollowUps',
        'overdueFollowUps'
    ));
}
  

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $leads = Lead::all();

    return view('follow-ups.create', compact('leads'));
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

        return redirect()
            ->route('follow-ups.index')
            ->with('sucess','Follow-up added Successfully.');
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
   public function edit(FollowUp $followUp)
{
    $leads = Lead::all();

    return view('follow-ups.edit', compact('followUp', 'leads'));
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

      return redirect()
    ->route('follow-ups.index')
    ->with('success', 'Follow-up updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FollowUp $followUp)
    {
        $followUp->delete();

       return redirect()
            ->route('follow-ups.index')
            ->with('success','Follow-up deleted Successfully');
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
