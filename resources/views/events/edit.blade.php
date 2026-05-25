@extends('layouts.app')

@section('content')
<h1>Edit Event</h1>
<form method="POST" action="{{ route('events.update', $event) }}">
    @csrf
    @method('PUT')

    @if ($errors->any())
        <div class="error-summary">
            Please correct the highlighted fields and submit again.
        </div>
    @endif

    <div class="field-group">
        <label class="required">Title</label>
        <input name="title" type="text" value="{{ old('title', $event->title) }}" placeholder="Event title"
            class="{{ $errors->has('title') ? 'input-error' : '' }}" required />
        @error('title')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <div class="field-group">
        <label class="required">Date</label>
        <input type="date" name="date" value="{{ old('date', $event->date) }}"
            class="{{ $errors->has('date') ? 'input-error' : '' }}" required />
        @error('date')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <div class="field-group">
        <label class="required">Status</label>
        <select name="status" class="{{ $errors->has('status') ? 'input-error' : '' }}" required>
            <option value="">Select status</option>
            <option value="upcoming" {{ old('status', $event->status) === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
            <option value="ongoing" {{ old('status', $event->status) === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
            <option value="done" {{ old('status', $event->status) === 'done' ? 'selected' : '' }}>Done</option>
        </select>
        @error('status')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <div class="field-group">
        <label>Category</label>
        <input name="category" type="text" value="{{ old('category', $event->category) }}" placeholder="Optional category" />
        @error('category')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <div class="field-group">
        <label>Organizer Name</label>
        <input name="organizer_name" type="text" value="{{ old('organizer_name', $event->organizer->name ?? '') }}" placeholder="Name of event organizer" 
            class="{{ $errors->has('organizer_name') ? 'input-error' : '' }}" />
        @error('organizer_name')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <button type="submit">Update event</button>
    <a class="button secondary" href="{{ route('events.show', $event) }}">Back to event</a>
</form>
@endsection