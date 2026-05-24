<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name','EventManager') }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css','resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @endif
</head>
<body class="app-root">
    <header class="app-header">
        <div class="header-brand">
            <a class="brand" href="{{ route('dashboard') }}">Event Manager</a>
        </div>
        <nav class="nav-links">
            @auth
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('events.index') }}">Events</a>
                <a href="{{ route('participants.index') }}">Participants</a>
                <a href="{{ route('notifications.index') }}">Notifications</a>
                <span class="nav-user">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="nav-form">
                    @csrf
                    <button type="submit" class="button secondary">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Sign up</a>
            @endauth
        </nav>
    </header>
    <main class="app-main">
        @if(session('success'))
            <div class="flash">{{ session('success') }}</div>
        @endif
        @yield('content')
    </main>
</body>
</html>