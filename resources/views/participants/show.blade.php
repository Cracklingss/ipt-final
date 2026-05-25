@extends('layouts.app')
@section('content')
<div class="page-header">
    <div class="page-header-text">
        <h1>{{ $participant->name }}</h1>
        <p>{{ $participant->email }}</p>
    </div>
    <div class="page-actions">
        <a class="btn btn-secondary" href="{{ route('participants.edit', $participant) }}">Edit</a>
        <form method="POST" action="{{ route('participants.destroy', $participant) }}" class="delete-form" onsubmit="return confirm('Delete this participant?');" style="margin: 0;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger-outline">Delete</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="detail-grid">
            <div class="detail-row">
                <span class="detail-label">Name</span>
                <span class="detail-value">{{ $participant->name }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Email</span>
                <span class="detail-value">{{ $participant->email }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Event</span>
                <span class="detail-value">
                    @if($participant->event)
                        <a href="{{ route('events.show', $participant->event) }}" style="color: var(--accent); text-decoration: none;">{{ $participant->event->title }}</a>
                    @else
                        <span class="td-muted">Not assigned</span>
                    @endif
                </span>
            </div>
        </div>
    </div>
</div>

<div style="margin-top: 1.5rem;">
    <a class="btn btn-secondary" href="{{ route('participants.index') }}">Back to participants</a>
</div>
@endsection