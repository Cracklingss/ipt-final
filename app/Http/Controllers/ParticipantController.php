<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use App\Models\Event;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $participants = Participant::with('event')->get();
        return view('participants.index', compact('participants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $events = Event::orderBy('date')->get();
        return view('participants.create', compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'event_id' => 'nullable|exists:events,id',
        ]);

        $participant = Participant::create($data);

        return redirect()->back()->with('success', 'Registered');
    }

    /**
     * Display the specified resource.
     */
    public function show(Participant $participant)
    {
        return view('participants.show', compact('participant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Participant $participant)
    {
        $events = Event::orderBy('date')->get();
        return view('participants.edit', compact('participant','events'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Participant $participant)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'event_id' => 'nullable|exists:events,id',
        ]);

        $participant->update($data);
        return redirect()->route('participants.show', $participant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Participant $participant)
    {
        $participant->delete();
        return redirect()->route('participants.index');
    }
}
