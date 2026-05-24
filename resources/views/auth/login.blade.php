@extends('layouts.app')

@section('content')
<h1>Login</h1>
<form method="POST" action="{{ route('login.attempt') }}">
    @csrf

    @if ($errors->any())
        <div class="error-summary">
            Please check your email and password.
        </div>
    @endif

    <div class="field-group">
        <label class="required">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com"
            class="{{ $errors->has('email') ? 'input-error' : '' }}" required autofocus />
        @error('email')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <div class="field-group">
        <label class="required">Password</label>
        <input type="password" name="password" placeholder="Password"
            class="{{ $errors->has('password') ? 'input-error' : '' }}" required />
        @error('password')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <button type="submit">Login</button>
</form>
<p class="form-caption">New here? <a href="{{ route('register') }}">Create an account</a>.</p>
@endsection