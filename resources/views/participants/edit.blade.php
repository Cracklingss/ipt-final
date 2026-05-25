@extends('layouts.app')
@section('content')
<div class="page-header">
    <div class="page-header-text">
        <h1>Edit Participant</h1>
        <p>Update participant information</p>
    </div>
</div>

<div class="form-card">
    @if ($errors->any())
        <div class="alert alert-error">
            <span>Please fix the highlighted fields</span>
        </div>
    @endif

    <form method="POST" action="{{ route('participants.update', $participant) }}">
        @csrf
        @method('PUT')

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

        <div class="form-footer">
            <button type="submit" class="btn btn-primary">Update participant</button>
            <a class="btn btn-secondary" href="{{ route('participants.show', $participant) }}">Cancel</a>
        </div>
    </form>
</div>
@endsection