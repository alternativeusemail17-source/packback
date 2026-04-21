@extends('layouts.app')

{{-- Page title --}}
@section('title', 'Register')

{{-- Navigation actions (Home button) --}}
@section('nav-actions')
    <button 
        type="button" 
        class="pb-button pb-button-top home-button"
        onclick="window.location.href='{{ route('welcome') }}'">
        <span class="button-text">Home</span>
        <span class="pb-icon">
            <svg viewBox="0 0 20 20" aria-hidden="true" class="rotated-icon">
                <path d="M4.5 10h10M10.5 5l4.5 5-4.5 5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"/>
            </svg>
        </span>
    </button>
@endsection

{{-- Hero section --}}
@section('hero')

    <div class="pb-layout">

        {{-- <div class="pb-showcase">
            <div class="pb-photo-shell">
                <div class="pb-badge pb-badge-top">
                    <strong>100%</strong>
                    <span>closet coverage</span>
                </div>
                <div class="pb-badge pb-badge-bottom">
                    <strong>5x</strong>
                    <span>packing clarity</span>
                </div>
            </div>

            <div class="pb-copy-block">
                <h2>Raise the quality bar for every outfit you pack.</h2>
                <p>
                    Get a guided walkthrough of PackBack and see how it keeps every dress,
                    laundry cycle, and travel look in one clean flow.
                </p>
            </div>
        </div>  --}}

        {{-- Right login panel --}}
        <div class="pb-panel">
            <div class="pb-panel-inner">
                
                {{-- Welcome message --}}
                <p class="pb-kicker">Welcome Back to PackBack</p>
                <h2 class="pb-form-heading">Log in to Your Account</h2>
                <p class="pb-panel-copy">
                    Access your closet, track your outfits, and manage your dresses effortlessly.
                </p>

                {{-- Login form --}}
                <form class="pb-form-grid-single" method="POST" action="{{ route('login') }}">
                    {{-- Email field --}}
                    <label class="pb-field pb-field-full">
                        <span>Email<span aria-hidden="true">*</span></span>
                        <input type="email" name="email" value="{{ old('email') }}" austocomplete="email">
                    </label>

                    {{-- Password field --}}
                    <label class="pb-field pb-field-full">
                        <span>Password<span aria-hidden="true">*</span></span>
                        <input type="password" id="password" name="password" autocomplete="new-password">
                    </label>

                    {{-- Display first validation error if any --}}
                    @if ($errors->any())
                        <div class="pb-error pb-global-error">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    {{-- Login options --}}
                    <div class="pb-login-options">
                        {{-- Remember me toggle --}}
                        <label class="pb-toggle">
                            <input type="checkbox" name="remember">
                            <span class="pb-slider"></span>
                            <span class="pb-toggle-label">Remember Me</span>
                        </label>
                        {{-- Forgot password link --}}
                        <a href="{{ route('password.request') }}" class="pb-forgot-password">Forgot Password?</a>
                    </div>
                
                    {{-- Account link --}}
                    <p class="pb-account-link">
                        Don't have an account? 
                        <a href="{{ route('register') }}">Register</a>
                    </p>

                    {{-- Submit button --}}
                    <button type="submit" class="pb-submit">Submit</button>
                </form>

            </div>
        </div>

    </div>

@endsection

{{-- Hero footer --}}
@section('hero-footer')
    @include('layouts.footer')
@endsection