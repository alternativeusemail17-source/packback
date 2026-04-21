@extends('layouts.app')

@section('title', 'Welcome')
@section('body-class', 'landing-shell-home')

@section('nav-actions')
    @guest
        <!-- Guest user -->
        <button 
            type="button" 
            class="pb-button pb-button-top"
            onclick="window.location.href='{{ route('register') }}'">
            <span class="button-text">Get Started</span>
            <span class="pb-icon">
                <svg viewBox="0 0 20 20" aria-hidden="true">
                    <path d="M4.5 10h10M10.5 5l4.5 5-4.5 5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"/>
                </svg>
            </span>
        </button>
    @endguest
@endsection

@section('hero')
<div class="hero-content">
    @auth
        <!-- Logged-in user view -->
        <div class="user-greeting">
            Hi, {{ Auth::user()->name }}
        </div>
        <p class="user-subtext">
            Welcome back! Manage your dresses easily.
        </p>
    @else
        <!-- Guest view -->
        <p class="eyebrow">Dress organizer</p>
        <h1 class="hero-title-normal">
            Track every dress without the clutter
        </h1>
        <p class="hero-copy">
            See where each piece is, what you already wore, and what still needs washing.
        </p>

        <!-- Reviews -->
        @include('partials.reviews')

        <!-- Pricing -->
        @include('partials.pricing')
    @endauth
</div>

@endsection


@section('hero-footer')
    @include('layouts.footer')
@endsection
