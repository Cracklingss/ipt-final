@extends('layouts.app')
@section('content')

<div class="auth-wrap">
    <div class="auth-card">
        <div>
            <h1>Create account</h1>
            <p class="auth-subtitle">Join EventManager to start managing events.</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-error" role="alert">
                <span>Please fix the errors below to create an account.</span>
            </div>
        @endif

        <form method="POST" action="{{ route('register.attempt') }}" style="display:grid; gap:.9rem; background:none; border:none; box-shadow:none; padding:0; border-radius:0;">
            @csrf
            <div class="field-group">
                <label class="required" for="name">Full name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Your name"
                    class="{{ $errors->has('name') ? 'input-error' : '' }}" required autofocus autocomplete="name" />
                @error('name')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="field-group">
                <label class="required" for="email">Email address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com"
                    class="{{ $errors->has('email') ? 'input-error' : '' }}" required autocomplete="email" />
                @error('email')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="field-group">
                <label class="required" for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="At least 8 characters"
                    class="{{ $errors->has('password') ? 'input-error' : '' }}" required autocomplete="new-password" />
                @error('password')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="field-group">
                <label class="required" for="password_confirmation">Confirm password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    placeholder="Repeat your password" required autocomplete="new-password" />
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%; margin-top:.25rem;">Create account</button>
        </form>

        <p class="auth-footer">Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
    </div>
</div>

@endsection
