@extends('layouts.app')
@section('content')
<h1>Create Notification</h1>
<form method="POST" action="{{ route('notifications.store') }}">
    @csrf

    @if ($errors->any())
        <div class="error-summary">
            A message and event are required to send a notification.
        </div>
    @endif

    <div class="field-group">
        <label class="required">Event</label>
        <select name="event_id" class="{{ $errors->has('event_id') ? 'input-error' : '' }}" required>
            <option value="">Select event</option>
            @foreach($events as $e)
                <option value="{{ $e->id }}" {{ old('event_id') == $e->id ? 'selected' : '' }}>{{ $e->title }}</option>
            @endforeach
        </select>
        @error('event_id')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <div class="field-group">
        <label class="required">Message</label>
        <textarea name="message" placeholder="Enter notification message"
            class="{{ $errors->has('message') ? 'input-error' : '' }}" required>{{ old('message') }}</textarea>
        @error('message')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <button type="submit">Send</button>
    <a class="button secondary" href="{{ route('notifications.index') }}">Back to notifications</a>
</form>
@endsection