@extends('layouts.app')
@section('content')
<div class="page-header">
    <div class="page-header-text">
        <h1>System Activities</h1>
        <p>Recent activities and notifications from your events.</p>
    </div>
</div>

<div class="card">
    @forelse($notifications as $n)
        <div class="activity-item">
            <div class="activity-header">
                <div>
                    <span class="activity-badge activity-{{ $n->activity_type ?? 'reminder' }}">
                        {{ ucfirst(str_replace('_', ' ', $n->activity_type ?? 'Reminder')) }}
                    </span>
                    <span class="activity-title">{{ $n->message }}</span>
                </div>
                <span class="activity-date">{{ $n->created_at->diffForHumans() }}</span>
            </div>
            @if($n->event)
                <div class="activity-meta">
                    Event: <strong>{{ $n->event->title }}</strong> 
                    — Status: <span class="badge {{ $n->event->status_badge_class }}">{{ $n->event->computed_status }}</span>
                </div>
            @endif
        </div>
    @empty
        <div class="empty-state">
            <div class="empty-state-icon">📋</div>
            <p>No activities recorded yet. Create, update, or delete events to see activity logs.</p>
        </div>
    @endforelse
</div>

@endsection