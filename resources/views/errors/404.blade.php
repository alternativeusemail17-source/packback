<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Page title, defaults to app name if no section title provided --}}
    <title>@yield('title', config('app.name', 'Packback'))</title>

    {{-- Vite asset loading: CSS, SCSS, and JS --}}
    @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="landing-shell">

<main class="landing-page">
    
    {{-- Hero section wrapper with optional background --}}
    <section class="hero-card" data-hero-card style="@yield('hero-bg')">
        <div class="hero-overlay"></div>

        {{-- Hero body content --}}
        <div class="hero-body">
            <div class="hero-scroll">
                {{-- Top navigation bar --}}
                <header class="navbar">
                    <nav class="navbar-container">
                        
                        {{-- Left-side nav links --}}
                        <div class="navbar-group navbar-group-left" style="visibility: hidden;">
                            <a href="#" class="navbar-link">Pricing</a>
                            <a href="#" class="navbar-link">Contact</a>
                        </div>

                        {{-- Brand/logo in center --}}
                        <a href="{{ url('/') }}" class="navbar-brand" style="text-decoration:none;">
                            <i class="fa-solid fa-backpack"></i>
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                {{-- Backpack lid --}}
                                <path d="M9 5C9 3.34315 10.3431 2 12 2C13.6569 2 15 3.34315 15 5V7H9V5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                {{-- Backpack body --}}
                                <rect x="5" y="7" width="14" height="14" rx="3" stroke="currentColor" stroke-width="2"/>
                                {{-- Backpack pocket --}}
                                <path d="M8 13H16V17C16 18.1046 15.1046 19 14 19H10C8.89543 19 8 18.1046 8 17V13Z" stroke="currentColor" stroke-width="1.5"/>
                                {{-- Side highlights --}}
                                <path d="M5 12H3V17C3 18.1046 3.89543 19 5 19V12Z" fill="currentColor" opacity="0.3"/>
                                <path d="M19 12H21V17C21 18.1046 20.1046 19 19 19V12Z" fill="currentColor" opacity="0.3"/>
                                {{-- Strap line --}}
                                <line x1="11" y1="9" x2="13" y2="9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                            <span>PackBack</span>
                        </a>

                        {{-- Right-side nav actions (login/register buttons, etc.) --}}
                        <div class="navbar-group navbar-group-right">
                            @yield('nav-actions')
                        </div>
                    </nav>
                </header>

                <div class="hero-content text-center py-20">
                    <p class="eyebrow text-gray-500 uppercase tracking-wider">Oops! Wrong Way</p>
                    <h1 class="hero-title-normal text-6xl font-bold text-gray-800 mt-4">
                        404
                    </h1>
                    <p class="hero-copy text-lg text-gray-600 mt-2">
                        The page you are trying to access is not allowed or does not exist.
                    </p>
                </div> 

                @if(session('success'))
                    <div id="toast-success" class="mt-4 px-4 py-2 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>

</main>

</body>
</html>
