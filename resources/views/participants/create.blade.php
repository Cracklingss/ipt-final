@extends('layouts.app')
@section('content')
<div class="page-header">
    <div class="page-header-text">
        <h1>Register Participant</h1>
        <p>Add a new participant to the system</p>
    </div>
</div>

<div class="form-card">
    @if ($errors->any())
        <div class="alert alert-error">
            <span>Please fix the highlighted fields</span>
        </div>
    @endif

    <form method="POST" action="{{ route('participants.store') }}">
        @csrf

        <div class="field-group">
            <label class="required">Name</label>
            <input name="name" type="text" value="{{ old('name') }}" placeholder="Participant name"
                class="{{ $errors->has('name') ? 'input-error' : '' }}" required />
            @error('name')<div class="field-error">{{ $message }}</div>@enderror
        </div>

        <div class="field-group">
            <label class="required">Email</label>
            <input name="email" type="email" value="{{ old('email') }}" placeholder="email@example.com"
                class="{{ $errors->has('email') ? 'input-error' : '' }}" required />
            @error('email')<div class="field-error">{{ $message }}</div>@enderror
        </div>

        <div class="field-group">
            <label>Event</label>
            <select name="event_id" class="{{ $errors->has('event_id') ? 'input-error' : '' }}">
                <option value="">No event</option>
                @foreach($events as $e)
                    <option value="{{ $e->id }}" {{ old('event_id') == $e->id ? 'selected' : '' }}>{{ $e->title }} ({{ $e->date }})</option>
                @endforeach
            </select>
            @error('event_id')<div class="field-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-footer">
            <button type="submit" class="btn btn-primary">Register participant</button>
            <a class="btn btn-secondary" href="{{ route('participants.index') }}">Cancel</a>
        </div>
    </form>
</div>
@endsection