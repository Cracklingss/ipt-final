@extends('layouts.app')

@section('content')
<h1>Create Event</h1>
<form method="POST" action="{{ route('events.store') }}">
    @csrf

    @if ($errors->any())
        <div class="error-summary">
            Please correct the highlighted fields and submit again.
        </div>
    @endif

    <div class="field-group">
        <label class="required">Title</label>
        <input name="title" type="text" value="{{ old('title') }}" placeholder="Event title"
            class="{{ $errors->has('title') ? 'input-error' : '' }}" required />
        @error('title')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <div class="field-group">
        <label class="required">Date</label>
        <input type="date" name="date" value="{{ old('date') }}"
            class="{{ $errors->has('date') ? 'input-error' : '' }}" required />
        @error('date')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <div class="field-group">
        <label class="required">Status</label>
        <select name="status" class="{{ $errors->has('status') ? 'input-error' : '' }}" required>
            <option value="">Select status</option>
            <option value="upcoming" {{ old('status', 'upcoming') === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
            <option value="ongoing" {{ old('status') === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
            <option value="done" {{ old('status') === 'done' ? 'selected' : '' }}>Done</option>
        </select>
        @error('status')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <div class="field-group">
        <label>Category</label>
        <input name="category" type="text" value="{{ old('category') }}" placeholder="Optional category" />
        @error('category')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <div class="field-group">
        <label>Organizer</label>
        <select name="event_organizer_id" class="{{ $errors->has('event_organizer_id') ? 'input-error' : '' }}">
            <option value="">No organizer</option>
            @foreach($organizers as $org)
                <option value="{{ $org->id }}" {{ old('event_organizer_id') == $org->id ? 'selected' : '' }}>{{ $org->name }}</option>
            @endforeach
        </select>
        @error('event_organizer_id')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <button type="submit">Create event</button>
    <a class="button secondary" href="{{ route('events.index') }}">Back to events</a>
</form>
@endsection