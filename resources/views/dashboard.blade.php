@extends('layouts.app')
@section('content')

<div class="page-header">
    <div class="page-header-text">
        <h1>Dashboard</h1>
        <p>Welcome back, {{ auth()->user()->name }}. Here's what's happening.</p>
    </div>
    <a class="btn btn-primary" href="{{ route('events.create') }}">+ New Event</a>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <strong>Total Events</strong>
        <span>{{ $totalEvents }}</span>
    </div>
    <div class="stat-card">
        <strong>Participants</strong>
        <span>{{ $totalParticipants }}</span>
    </div>
    <div class="stat-card">
        <strong>Upcoming</strong>
        <span>{{ $upcomingEvents }}</span>
    </div>
    <div class="stat-card">
        <strong>Ongoing</strong>
        <span>{{ $ongoingEvents }}</span>
    </div>
    <div class="stat-card">
        <strong>Done</strong>
        <span>{{ $doneEvents }}</span>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2>Upcoming Events</h2>
        <a class="btn btn-secondary btn-sm" href="{{ route('events.index') }}">View all</a>
    </div>

    @forelse($latestEvents as $event)
        <div style="padding: .9rem 1.5rem; border-bottom: 1px solid var(--border); display:flex; align-items:center; justify-content:space-between; gap:1rem; flex-wrap:wrap;">
            <div style="display:flex; align-items:center; gap:.75rem; flex-wrap:wrap;">
                <span class="badge {{ $event->status_badge_class }}">{{ $event->computed_status }}</span>
                <a href="{{ route('events.show', $event) }}" style="font-weight:600; color:var(--text); text-decoration:none; font-size:.95rem;">{{ $event->title }}</a>
            </div>
            <div style="display:flex; align-items:center; gap:1.25rem; color:var(--muted); font-size:.86rem; flex-shrink:0;">
                <span>&#128197; {{ \Carbon\Carbon::parse($event->date)->format('M j, Y') }}</span>
                <span>&#128101; {{ $event->participants_count }} participant{{ $event->participants_count === 1 ? '' : 's' }}</span>
            </div>
        </div>
    @empty
        <div class="empty-state">
            <div class="empty-state-icon">&#128197;</div>
            <p>No events yet. Create your first event to get started.</p>
            <a class="btn btn-primary btn-sm" href="{{ route('events.create') }}">Create Event</a>
        </div>
    @endforelse
</div>

@endsection
