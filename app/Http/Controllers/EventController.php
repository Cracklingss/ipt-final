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
        return view('events.create');
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
            'organizer_name' => 'nullable|string|max:150',
        ]);

        // Handle organizer
        $organizerId = null;
        if ($data['organizer_name']) {
            $organizer = EventOrganizer::firstOrCreate(
                ['name' => $data['organizer_name']]
            );
            $organizerId = $organizer->id;
        }

        // Create event
        $event = Event::create([
            'title' => $data['title'],
            'date' => $data['date'],
            'status' => $data['status'],
            'category' => $data['category'],
            'event_organizer_id' => $organizerId,
        ]);

        // Log activity
        \App\Models\Notification::create([
            'event_id' => $event->id,
            'message' => "Event '{$event->title}' created",
            'activity_type' => 'created',
        ]);

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
        return view('events.edit', compact('event'));
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
            'organizer_name' => 'nullable|string|max:150',
        ]);

        // Track if status changed for activity logging
        $statusChanged = $event->status !== $data['status'];
        $oldStatus = $event->status;

        // Handle organizer
        $organizerId = null;
        if ($data['organizer_name']) {
            $organizer = EventOrganizer::firstOrCreate(
                ['name' => $data['organizer_name']]
            );
            $organizerId = $organizer->id;
        }

        // Update event
        $event->update([
            'title' => $data['title'],
            'date' => $data['date'],
            'status' => $data['status'],
            'category' => $data['category'],
            'event_organizer_id' => $organizerId,
        ]);

        // Log activity if status changed
        if ($statusChanged) {
            \App\Models\Notification::create([
                'event_id' => $event->id,
                'message' => "Event status changed from '{$oldStatus}' to '{$data['status']}'",
                'activity_type' => 'status_changed',
            ]);
        }

        return redirect()->route('events.show', $event);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $eventTitle = $event->title;
        $event->delete();
        return redirect()->route('events.index')->with('success', "Event '{$eventTitle}' has been deleted.");
    }
}
