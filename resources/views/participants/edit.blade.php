@extends('layouts.app')

@section('content')
<h1>Edit Participant</h1>
<form method="POST" action="{{ route('participants.update', $participant) }}">
    @csrf
    @method('PUT')

    @if ($errors->any())
        <div class="error-summary">
            Please fix the highlighted fields.
        </div>
    @endif

    <div class="field-group">
        <label class="required">Name</label>
        <input name="name" type="text" value="{{ old('name', $participant->name) }}" placeholder="Name"
            class="{{ $errors->has('name') ? 'input-error' : '' }}" required />
        @error('name')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <div class="field-group">
        <label class="required">Email</label>
        <input name="email" type="email" value="{{ old('email', $participant->email) }}" placeholder="email@example.com"
            class="{{ $errors->has('email') ? 'input-error' : '' }}" required />
        @error('email')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <div class="field-group">
        <label>Event</label>
        <select name="event_id" class="{{ $errors->has('event_id') ? 'input-error' : '' }}">
            <option value="">No event</option>
            @foreach($events as $e)
                <option value="{{ $e->id }}" {{ old('event_id', $participant->event_id) == $e->id ? 'selected' : '' }}>{{ $e->title }} ({{ $e->date }})</option>
            @endforeach
        </select>
        @error('event_id')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <button type="submit">Update participant</button>
    <a class="button secondary" href="{{ route('participants.show', $participant) }}">Back to participant</a>
</form>
@endsection