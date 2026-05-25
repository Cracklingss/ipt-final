@extends('layouts.app')
@section('content')
<div class="page-header">
    <div class="page-header-text">
        <h1>Participants</h1>
    </div>
    <div class="page-actions">
        <a class="btn btn-primary" href="{{ route('participants.create') }}">Add participant</a>
    </div>
</div>

@if($participants->count() > 0)
    <div class="card">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Event</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($participants as $p)
                    <tr>
                        <td><a href="{{ route('participants.show',$p) }}" style="color: var(--accent); font-weight: 500; text-decoration: none;">{{ $p->name }}</a></td>
                        <td class="td-muted">{{ $p->email }}</td>
                        <td>
                            @if($p->event)
                                <a href="{{ route('events.show',$p->event) }}" style="color: var(--accent); text-decoration: none;">{{ $p->event->title }}</a>
                            @else
                                <span class="td-muted">—</span>
                            @endif
                        </td>
                        <td>
                            <div class="td-actions">
                                <a class="btn btn-secondary btn-sm" href="{{ route('participants.edit',$p) }}">Edit</a>
                                <form method="POST" action="{{ route('participants.destroy',$p) }}" class="delete-form" onsubmit="return confirm('Delete this participant?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger-outline btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    <div class="empty-state">
        <div class="empty-state-icon">📭</div>
        <p>No participants yet</p>
        <a class="btn btn-primary" href="{{ route('participants.create') }}">Register first participant</a>
    </div>
@endif
@endsection