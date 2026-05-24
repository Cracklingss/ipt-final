@extends('layouts.app')

@section('content')
<h1>{{ $event->title }}</h1>
<div class="content-list">
    <li><strong>Date</strong> {{ $event->date }}</li>
    <li><strong>Status</strong> {{ $event->computed_status }}</li>
    <li><strong>Participants</strong> {{ $event->participants->count() }}</li>
    <li><strong>Category</strong> {{ $event->category ?? '–' }}</li>
    <li><strong>Organizer</strong> {{ $event->organizer->name ?? 'Unassigned' }}</li>
</div>

<div class="page-actions">
    <a class="button secondary" href="{{ route('events.index') }}">Back to events</a>
    <a class="button secondary" href="{{ route('events.edit',$event) }}">Edit</a>
</div>

@if ($errors->any())
    <div class="error-summary">
        Please fix the highlighted fields in the registration or notification section.
    </div>
@endif

<h2>Participants</h2>
<ul class="content-list">
    @forelse($event->participants as $p)
        <li>{{ $p->name }} ({{ $p->email }})</li>
    @empty
        <li>No participants registered yet.</li>
    @endforelse
</ul>

<h2>Notifications</h2>
<ul class="content-list">
    @forelse($event->notifications as $n)
        <li>{{ $n->message }} — {{ $n->date_sent ?? 'Pending' }}</li>
    @empty
        <li>No notifications sent yet.</li>
    @endforelse
</ul>

<h3>Register</h3>
<form method="POST" action="{{ route('participants.store') }}">
    @csrf
    <input type="hidden" name="event_id" value="{{ $event->id }}">

    <div class="field-group">
        <label class="required">Your name</label>
        <input name="name" type="text" value="{{ old('name') }}" placeholder="Full name"
            class="{{ $errors->has('name') ? 'input-error' : '' }}" required />
        @error('name')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <div class="field-group">
        <label class="required">Email</label>
        <input name="email" type="email" value="{{ old('email') }}" placeholder="name@example.com"
            class="{{ $errors->has('email') ? 'input-error' : '' }}" required />
        @error('email')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <button type="submit">Register</button>
</form>

<h3>Send notification</h3>
<form method="POST" action="{{ route('notifications.store') }}">
    @csrf
    <input type="hidden" name="event_id" value="{{ $event->id }}">

    <div class="field-group">
        <label class="required">Message</label>
        <textarea name="message" placeholder="Write a short update or reminder"
            class="{{ $errors->has('message') ? 'input-error' : '' }}" required>{{ old('message') }}</textarea>
        @error('message')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <button type="submit">Send</button>
</form>

<div class="actions">
    <form method="POST" action="{{ route('events.destroy',$event) }}">
        @csrf
        @method('DELETE')
        <button class="button secondary" type="submit">Delete</button>
    </form>
</div>
@endsection