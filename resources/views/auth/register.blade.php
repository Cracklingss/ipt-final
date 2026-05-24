@extends('layouts.app')

@section('content')
<h1>Sign up</h1>
<form method="POST" action="{{ route('register.attempt') }}">
    @csrf

    @if ($errors->any())
        <div class="error-summary">
            Please fix the errors below to create an account.
        </div>
    @endif

    <div class="field-group">
        <label class="required">Name</label>
        <input type="text" name="name" value="{{ old('name') }}" placeholder="Your name"
            class="{{ $errors->has('name') ? 'input-error' : '' }}" required autofocus />
        @error('name')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <div class="field-group">
        <label class="required">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com"
            class="{{ $errors->has('email') ? 'input-error' : '' }}" required />
        @error('email')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <div class="field-group">
        <label class="required">Password</label>
        <input type="password" name="password" placeholder="Create a password"
            class="{{ $errors->has('password') ? 'input-error' : '' }}" required />
        @error('password')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <div class="field-group">
        <label class="required">Confirm Password</label>
        <input type="password" name="password_confirmation" placeholder="Repeat password" required />
    </div>

    <button type="submit">Create account</button>
</form>
<p class="form-caption">Already have an account? <a href="{{ route('login') }}">Login</a>.</p>
@endsection