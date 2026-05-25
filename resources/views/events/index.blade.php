@extends('layouts.app')
@section('content')

<div class="page-header">
    <div class="page-header-text">
        <h1>Events</h1>
        <p>Browse, search, and manage all your events.</p>
    </div>
    <a class="btn btn-primary" href="{{ route('events.create') }}">+ Create Event</a>
</div>

<div class="card">
    {{-- Filter bar --}}
    <form method="GET" action="{{ route('events.index') }}" style="background:none; border:none; box-shadow:none; padding:0; border-radius:0; gap:0;">
        <div class="filter-bar">
            <div class="field-group">
                <label for="search">Search by title</label>
                <input type="search" id="search" name="search" value="{{ old('search', $search ?? '') }}" placeholder="Event name…" />
            </div>
            <div class="field-group">
                <label for="date">Filter by date</label>
                <input type="date" id="date" name="date" value="{{ old('date', $date ?? '') }}" />
            </div>
            <button type="submit" class="btn btn-secondary btn-sm" style="align-self:flex-end;">Filter</button>
            @if(($search ?? '') || ($date ?? ''))
                <a href="{{ route('events.index') }}" class="btn btn-secondary btn-sm" style="align-self:flex-end;">Clear</a>
            @endif
        </div>
    </form>

    @if(($search ?? '') || ($date ?? ''))
        <div style="padding:.6rem 1.25rem; background:#fffbeb; border-bottom:1px solid #fde68a; font-size:.85rem; color:#92400e;">
            Showing {{ $events->count() }} result{{ $events->count() === 1 ? '' : 's' }}
            @if($search) for &ldquo;{{ $search }}&rdquo; @endif
            @if($date) on {{ \Carbon\Carbon::parse($date)->format('M j, Y') }} @endif
        </div>
    @endif

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Category</th>
                    <th>Organizer</th>
                    <th>Participants</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                    <tr>
                        <td>
                            <a href="{{ route('events.show', $event) }}" style="font-weight:600; color:var(--text); text-decoration:none;">
                                {{ $event->title }}
                            </a>
                        </td>
                        <td class="td-muted">{{ \Carbon\Carbon::parse($event->date)->format('M j, Y') }}</td>
                        <td><span class="badge {{ $event->status_badge_class }}">{{ $event->computed_status }}</span></td>
                        <td class="td-muted">{{ $event->category ?: '—' }}</td>
                        <td class="td-muted">{{ $event->organizer->name ?? '—' }}</td>
                        <td class="td-muted">{{ $event->participants_count }}</td>
                        <td>
                            <div class="td-actions">
                                <a href="{{ route('events.show', $event) }}" class="btn btn-secondary btn-sm">View</a>
                                <a href="{{ route('events.edit', $event) }}" class="btn btn-secondary btn-sm">Edit</a>
                                <form method="POST" action="{{ route('events.destroy', $event) }}" class="delete-form"
                                      onsubmit="return confirm('Delete this event? This cannot be undone.')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger-outline btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <p>No events found. Try a different search or create a new event.</p>
                                <a class="btn btn-primary btn-sm" href="{{ route('events.create') }}">Create Event</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
