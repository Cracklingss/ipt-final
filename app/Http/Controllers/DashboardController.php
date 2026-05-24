<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Participant;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalEvents = Event::count();
        $totalParticipants = Participant::count();
        $upcomingEvents = Event::whereDate('date', '>', now()->toDateString())->count();
        $ongoingEvents = Event::whereDate('date', now()->toDateString())->count();
        $doneEvents = Event::whereDate('date', '<', now()->toDateString())->count();
        $latestEvents = Event::withCount('participants')->orderBy('date')->limit(5)->get();

        return view('dashboard', compact(
            'totalEvents',
            'totalParticipants',
            'upcomingEvents',
            'ongoingEvents',
            'doneEvents',
            'latestEvents'
        ));
    }
}
