<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Page title, defaults to app name if no section title provided --}}
    <title>@yield('title', config('app.name', 'Packback'))</title>

    {{-- Vite asset loading: CSS, SCSS, and JS --}}
    @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js'])

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="landing-shell @yield('body-class')">
@php
    $navUser = auth()->user();
    $navUserName = trim((string) optional($navUser)->name);
    $navUserInitial = $navUserName !== '' ? mb_strtoupper(mb_substr($navUserName, 0, 1)) : 'P';
@endphp

<main class="landing-page">
    
    {{-- Hero section wrapper with optional background --}}
    <section class="hero-card" data-hero-card style="@yield('hero-bg')">
        <div class="hero-overlay"></div>

        {{-- Hero body content --}}
        <div class="hero-body">
            <div class="hero-scroll">
                {{-- Top navigation bar --}}
                <header class="navbar">
                    @auth
                        <nav class="navbar-container navbar-container-auth">
                            <a href="{{ url('/') }}" class="navbar-brand navbar-brand-left" style="text-decoration:none;">
                                <svg width="200" height="200" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M5 11C5 7.68629 7.68629 5 11 5H13C16.3137 5 19 7.68629 19 11V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V11Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                                    <path d="M8 13C8 12.4477 8.44772 12 9 12H15C15.5523 12 16 12.4477 16 13V17C16 17.5523 15.5523 18 15 18H9C8.44772 18 8 17.5523 8 17V13Z" fill="currentColor" fill-opacity="0.1" stroke="currentColor" stroke-width="1.5"/>
                                    <path d="M5 10H19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                                <span>PackBack</span>
                            </a>

                            <div class="navbar-group navbar-group-center">
                                <a href="{{ route('dresses.index') }}" @class(['navbar-link', 'is-active' => request()->routeIs('dresses.*')])>Dresses</a>
                                <a href="{{ route('queues.index') }}" @class(['navbar-link', 'is-active' => request()->routeIs('queues.*')])>Queue</a>
                                <a href="#" class="navbar-link">Pick Random</a>
                                <a href="#" class="navbar-link">Sell</a>
                            </div>

                            <div class="navbar-group navbar-group-right">
                                @yield('nav-actions')
                                <div class="navbar-utility-cluster" aria-label="Account controls">
                                    <button type="button" class="navbar-utility-button" aria-label="Search">
                                        <svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="11" cy="11" r="6.5" />
                                            <path d="m16 16 4.5 4.5" />
                                        </svg>
                                    </button>

                                    <button type="button" class="navbar-utility-button navbar-utility-button-notice" aria-label="Notifications">
                                        <svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M15 17H5.5a1 1 0 0 1-.77-1.64L6 13.8V10a6 6 0 1 1 12 0v3.8l1.27 1.56A1 1 0 0 1 18.5 17H15" />
                                            <path d="M9.5 19a2.5 2.5 0 0 0 5 0" />
                                        </svg>
                                    </button>

                                    <a href="{{ route('profile.show') }}" @class(['navbar-account-chip', 'is-active' => request()->routeIs('profile.*')])>
                                        <span class="navbar-account-avatar" aria-hidden="true">{{ $navUserInitial }}</span>
                                    </a>
                                </div>
                            </div>
                        </nav>
                    @else
                        <nav class="navbar-container">
                            <div class="navbar-group navbar-group-left">
                                <a href="#pricing" class="navbar-link">Pricing</a>
                                <a href="#" class="navbar-link">Contact</a>
                                <a href="{{ route('reviews.index') }}" @class(['navbar-link', 'is-active' => request()->routeIs('reviews.*')])>Reviews</a>
                            </div>

                            <a href="{{ url('/') }}" class="navbar-brand" style="text-decoration:none;">
                                <svg width="200" height="200" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M5 11C5 7.68629 7.68629 5 11 5H13C16.3137 5 19 7.68629 19 11V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V11Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                                    <path d="M8 13C8 12.4477 8.44772 12 9 12H15C15.5523 12 16 12.4477 16 13V17C16 17.5523 15.5523 18 15 18H9C8.44772 18 8 17.5523 8 17V13Z" fill="currentColor" fill-opacity="0.1" stroke="currentColor" stroke-width="1.5"/>
                                    <path d="M5 10H19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                                <span>PackBack</span>
                            </a>

                            <div class="navbar-group navbar-group-right">
                                @yield('nav-actions')
                            </div>
                        </nav>
                    @endauth
                </header>

                {{-- Main hero content (login/register/OTP/reset) --}}
                @yield('hero')

                @if(session('success'))
                    <div id="toast-success">
                        {{ session('success') }}
                    </div>
                @endif

                @hasSection('content')
                    @yield('content')
                @endif

                {{-- Optional hero footer (e.g., footer links) --}}
                @hasSection('hero-footer')
                    @yield('hero-footer')
                @endif
            </div>
        </div>
    </section>

</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
