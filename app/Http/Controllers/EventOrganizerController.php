<?php

namespace App\Http\Controllers;

use App\Models\EventOrganizer;
use Illuminate\Http\Request;
use App\Models\Event;

class EventOrganizerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organizers = EventOrganizer::with('events')->get();
        return view('organizers.index', compact('organizers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('organizers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'contact' => 'nullable|string',
        ]);

        $org = EventOrganizer::create($data);
        return redirect()->route('organizers.show', $org);
    }

    /**
     * Display the specified resource.
     */
    public function show(EventOrganizer $eventOrganizer)
    {
        $eventOrganizer->load('events','admins');
        return view('organizers.show', ['organizer' => $eventOrganizer]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventOrganizer $eventOrganizer)
    {
        return view('organizers.edit', compact('eventOrganizer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EventOrganizer $eventOrganizer)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'contact' => 'nullable|string',
        ]);

        $eventOrganizer->update($data);
        return redirect()->route('organizers.show', $eventOrganizer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventOrganizer $eventOrganizer)
    {
        $eventOrganizer->delete();
        return redirect()->route('organizers.index');
    }
}
