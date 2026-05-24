<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\EventOrganizer;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Event::with('organizer')->withCount('participants')->orderBy('date');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        $events = $query->get();

        return view('events.index', [
            'events' => $events,
            'search' => $request->search,
            'date' => $request->date,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $organizers = EventOrganizer::all();
        return view('events.create', compact('organizers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:150',
            'date' => 'required|date',
            'status' => 'required|in:upcoming,ongoing,done',
            'category' => 'nullable|string|max:80',
            'event_organizer_id' => 'nullable|exists:event_organizers,id',
        ]);

        $event = Event::create($data);

        return redirect()->route('events.show', $event);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event->load('participants', 'notifications', 'organizer');
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $organizers = EventOrganizer::all();
        return view('events.edit', compact('event','organizers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'title' => 'required|string|max:150',
            'date' => 'required|date',
            'status' => 'required|in:upcoming,ongoing,done',
            'category' => 'nullable|string|max:80',
            'event_organizer_id' => 'nullable|exists:event_organizers,id',
        ]);

        $event->update($data);
        return redirect()->route('events.show', $event);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index');
    }
}
