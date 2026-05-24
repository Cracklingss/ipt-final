@extends('layouts.app')

@section('content')
<h1>Edit Notification</h1>
<form method="POST" action="{{ route('notifications.update', $notification) }}">
    @csrf
    @method('PUT')

    @if ($errors->any())
        <div class="error-summary">
            Please fix the highlighted fields.
        </div>
    @endif

    <div class="field-group">
        <label class="required">Event</label>
        <select name="event_id" class="{{ $errors->has('event_id') ? 'input-error' : '' }}" required>
            <option value="">Select event</option>
            @foreach($events as $e)
                <option value="{{ $e->id }}" {{ old('event_id', $notification->event_id) == $e->id ? 'selected' : '' }}>{{ $e->title }}</option>
            @endforeach
        </select>
        @error('event_id')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <div class="field-group">
        <label class="required">Message</label>
        <textarea name="message" placeholder="Write the notification message" class="{{ $errors->has('message') ? 'input-error' : '' }}" required>{{ old('message', $notification->message) }}</textarea>
        @error('message')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <button type="submit">Update notification</button>
    <a class="button secondary" href="{{ route('notifications.show', $notification) }}">Back to notification</a>
</form>
@endsection