@extends('layouts.app')

@section('content')
<h1>Dashboard</h1>
<p class="form-caption">A quick overview of your event activity, participants, and current status trends.</p>

<div class="stats-grid">
    <div class="stat-card">
        <strong>Total events</strong>
        <span>{{ $totalEvents }}</span>
    </div>
    <div class="stat-card">
        <strong>Total participants</strong>
        <span>{{ $totalParticipants }}</span>
    </div>
    <div class="stat-card">
        <strong>Upcoming events</strong>
        <span>{{ $upcomingEvents }}</span>
    </div>
    <div class="stat-card">
        <strong>Ongoing events</strong>
        <span>{{ $ongoingEvents }}</span>
    </div>
    <div class="stat-card">
        <strong>Done events</strong>
        <span>{{ $doneEvents }}</span>
    </div>
</div>

<section>
    <h2>Upcoming events</h2>
    <div class="events-grid">
        @forelse($latestEvents as $event)
            <article class="event-card">
                <a class="event-title" href="{{ route('events.show', $event) }}">{{ $event->title }}</a>
                <div class="event-meta">
                    <span class="badge {{ $event->status_badge_class }}">{{ $event->computed_status }}</span>
                    <span>{{ $event->date }}</span>
                    <span>{{ $event->participants_count }} participant{{ $event->participants_count === 1 ? '' : 's' }}</span>
                </div>
            </article>
        @empty
            <div class="flash">No events are available yet.</div>
        @endforelse
    </div>
</section>
@endsection