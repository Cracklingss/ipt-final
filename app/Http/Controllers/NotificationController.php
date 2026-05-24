<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Event;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = Notification::with('event')->latest()->get();
        return view('notifications.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $events = Event::orderBy('date')->get();
        return view('notifications.create', compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'event_id' => 'required|exists:events,id',
            'message' => 'required|string',
        ]);

        $notification = Notification::create([
            'event_id' => $data['event_id'],
            'message' => $data['message'],
            'date_sent' => null,
        ]);

        $notification->sendReminder();

        return redirect()->route('events.show', $data['event_id']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification)
    {
        return view('notifications.show', compact('notification'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notification $notification)
    {
        $events = Event::orderBy('date')->get();
        return view('notifications.edit', compact('notification','events'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notification $notification)
    {
        $data = $request->validate([
            'event_id' => 'required|exists:events,id',
            'message' => 'required|string',
        ]);

        $notification->update($data);
        return redirect()->route('notifications.show', $notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        $notification->delete();
        return redirect()->route('notifications.index');
    }
}
