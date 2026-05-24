@extends('layouts.app')
@section('content')

<div class="auth-wrap">
    <div class="auth-card">
        <div>
            <h1>Welcome back</h1>
            <p class="auth-subtitle">Sign in to your EventManager account.</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-error" role="alert">
                <span class="alert-icon">&#9888;</span>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('login.attempt') }}" style="display:grid; gap:.9rem; background:none; border:none; box-shadow:none; padding:0; border-radius:0;">
            @csrf
            <div class="field-group">
                <label class="required" for="email">Email address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com"
                    class="{{ $errors->has('email') ? 'input-error' : '' }}" required autofocus autocomplete="email" />
                @error('email')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="field-group">
                <label class="required" for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Your password"
                    class="{{ $errors->has('password') ? 'input-error' : '' }}" required autocomplete="current-password" />
                @error('password')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%; margin-top:.25rem;">Sign in</button>
        </form>

        <p class="auth-footer">Don't have an account? <a href="{{ route('register') }}">Create one</a></p>
    </div>
</div>

@endsection
