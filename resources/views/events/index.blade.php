@extends('layouts.app')

@section('content')
<h1>Events</h1>
<div class="page-actions">
    <form class="search-form" method="GET" action="{{ route('events.index') }}">
        <div class="field-group search-field">
            <label>Search by title</label>
            <input type="search" name="search" value="{{ old('search', $search ?? '') }}" placeholder="Search events" />
        </div>
        <div class="field-group search-field">
            <label>Date</label>
            <input type="date" name="date" value="{{ old('date', $date ?? '') }}" />
        </div>
        <button type="submit" class="button secondary">Filter</button>
    </form>
    <a class="button" href="{{ route('events.create') }}">Create event</a>
</div>

@if((isset($search) && $search !== '') || (isset($date) && $date !== ''))
    <div class="flash">
        Showing {{ $events->count() }} result{{ $events->count() === 1 ? '' : 's' }}
        @if($search) for "{{ $search }}" @endif
        @if($date) on {{ $date }} @endif
    </div>
@endif

<div class="events-grid">
    @forelse($events as $event)
        <article class="event-card">
            <a class="event-title" href="{{ route('events.show', $event) }}">{{ $event->title }}</a>
            <div class="event-meta">
                <span class="badge {{ $event->status_badge_class }}">{{ $event->computed_status }}</span>
                <span>{{ $event->date }}</span>
                <span>{{ $event->participants_count }} participant{{ $event->participants_count === 1 ? '' : 's' }}</span>
                @if($event->organizer)
                    <span>{{ $event->organizer->name }}</span>
                @endif
            </div>
            <p class="event-summary">{{ $event->category ?: 'No category specified' }}</p>
        </article>
    @empty
        <div class="flash">No events found. Create a new event to get started.</div>
    @endforelse
</div>
@endsection