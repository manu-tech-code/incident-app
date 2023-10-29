<?php

namespace App\Http\Controllers;

use App\Models\IncidentRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Nette\Utils\Random;

class IncidentRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $personnel = User::whereRole(2)->get();
        if (Auth::user()->role === 1){
            $incidents = IncidentRequest::with('user')->get();
        }
        elseif (Auth::user()->role === 2){
            $incidents = IncidentRequest::whereItPersonnelId(Auth::id())->get();
        }
        else {
            $incidents = IncidentRequest::whereUserId(Auth::id())->get();
        }

        return view('incidents.index', compact('incidents', 'personnel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $ITPersonnel = User::whereRole(2)->get();
        return view('incidents.create', compact('ITPersonnel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $lastIncident = IncidentRequest::orderBy('id', 'desc')->first();

        // Extract the number and increment it
        $lastNumber = $lastIncident ? intval(substr($lastIncident->number, 4)) : 0;
        $currentNumber = $lastNumber + 1;

        // Format the new incident number
        $formattedNumber = 'INC.' . str_pad($currentNumber, 4, '0', STR_PAD_LEFT);

        // Create the new incident
        Auth::user()->incident()->create(array_merge([
            'number' => $formattedNumber,
            'caller' => Auth::user()->name,
        ], $request->all()));

        return redirect(route('incidents.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(IncidentRequest $incident): View
    {
        return view('incidents.view', compact('incident'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IncidentRequest $incident)
    {

        return view('incidents.edit', compact('incident'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IncidentRequest $incidentRequest)
    {
        $incidentRequest->update($request->all());
        return redirect()->route('incidents.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IncidentRequest $incident): RedirectResponse
    {
        $incident->deleteOrFail();
        return redirect()->route('incidents.index');
    }

    public function assign(IncidentRequest $incident, Request $request)
    {
        $incident->update(['it_personnel_id' => (int)$request->assign]);
        return redirect()->route('incidents.index');
    }

    public function status(IncidentRequest $incident, Request $request)
    {
        $status = '';
        if ($incident->incident_state === 'Pending') {
            $status = 'In Progress';
        }
        elseif ($incident->incident_state === 'In Progress'){
            $status = 'Resolved';
        }
        else {
            null;
        }
        $incident->update(['incident_state' => $status]);
        return redirect()->route('incidents.index');
    }
}
