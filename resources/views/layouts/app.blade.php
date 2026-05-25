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

<!-- Header -->
<header class="app-header">
    <div class="app-header-inner">

        <div class="app-header-top">

            <div class="header-brand">
                <a class="brand" href="{{ route('dashboard') }}">
                    EventManager
                </a>
            </div>

            <input type="checkbox" id="nav-toggle" class="nav-toggle">

            <label for="nav-toggle" class="nav-burger">
                ≡
            </label>

            <nav class="nav-links">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('events.index') }}"
                       class="{{ request()->routeIs('events.*') ? 'active' : '' }}">
                        Events
                    </a>

                    <a href="{{ route('participants.index') }}"
                       class="{{ request()->routeIs('participants.*') ? 'active' : '' }}">
                        Participants
                    </a>

                    <a href="{{ route('notifications.index') }}"
                       class="{{ request()->routeIs('notifications.*') ? 'active' : '' }}">
                        Notifications
                    </a>

                    <div class="nav-sep"></div>

                    <span class="nav-user">
                        {{ auth()->user()->name }}
                    </span>

                    <form method="POST"
                          action="{{ route('logout') }}"
                          class="nav-form">
                        @csrf

                        <button type="submit" class="btn-ghost">
                            Logout
                        </button>
                    </form>

                @else

                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Sign up</a>

                @endauth
            </nav>

        </div>

    </div>
</header>

<main class="app-main">
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-error" role="alert">
            <span>{{ session('error') }}</span>
        </div>
    @endif
    @yield('content')
</main>

</body>
</html>
