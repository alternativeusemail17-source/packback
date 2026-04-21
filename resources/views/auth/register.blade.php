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

        {{-- Left showcase column
        <div class="pb-showcase">
            <div class="pb-photo-shell">
                Top badge
                <div class="pb-badge pb-badge-top">
                    <strong>100%</strong>
                    <span>closet coverage</span>
                </div>

                Bottom badge
                <div class="pb-badge pb-badge-bottom">
                    <strong>5x</strong>
                    <span>packing clarity</span>
                </div>
            </div>

            Copy block with headline and description
            <div class="pb-copy-block">
                <h2>Raise the quality bar for every outfit you pack.</h2>
                <p>
                    Get a guided walkthrough of PackBack and see how it keeps every dress,
                    laundry cycle, and travel look in one clean flow.
                </p>
            </div>
        </div> --}}

        {{-- Right registration panel --}}
        <div class="pb-panel">
            <div class="pb-panel-inner">
                
                {{-- Welcome message --}}
                <p class="pb-kicker">Register with PackBack</p>
                <h2 class="pb-form-heading">Get started with PackBack</h2>
                <p class="pb-panel-copy">
                    Sign up to track, manage, and organize your dresses effortlessly.
                </p>

                {{-- Registration form --}}
                <form class="pb-form-grid-double" method="POST" action="{{ route('register') }}">
                    
                    {{-- First Name field --}}
                    <label class="pb-field">
                        <span>First Name<span aria-hidden="true">*</span></span>
                        <input type="text" name="firstname" value="{{ old('firstname') }}" autocomplete="given-name">
                        @error('firstname')
                        <span class="pb-error">{{ $message }}</span>
                        @enderror
                    </label>

                    {{-- Last Name field --}}
                    <label class="pb-field">
                        <span>Last Name<span aria-hidden="true">*</span></span>
                        <input type="text" name="lastname" value="{{ old('lastname') }}" autocomplete="family-name">
                        @error('lastname')
                        <span class="pb-error">{{ $message }}</span>
                        @enderror
                    </label>

                    {{-- Email field --}}
                    <label class="pb-field pb-field-full">
                        <span>Email<span aria-hidden="true">*</span></span>
                        <input type="email" name="email" value="{{ old('email') }}" autocomplete="email">
                        @error('email')
                        <span class="pb-error">{{ $message }}</span>
                        @enderror
                    </label>

                    {{-- Password field with strength bar --}}
                    <label class="pb-field pb-field-full">
                        <span>Password<span aria-hidden="true">*</span></span>
                        <input type="password" id="password" name="password" autocomplete="new-password">
                        @error('password')
                        <span class="pb-error">{{ $message }}</span>
                        @enderror
                        <div id="password-strength-bar">
                            <div id="password-strength-fill"></div>
                        </div>
                    </label>
                
                    {{-- Confirm Password field --}}
                    <label class="pb-field pb-field-full">
                        <span>Confirm Password<span aria-hidden="true">*</span></span>
                        <input type="password" name="password_confirmation" autocomplete="new-password">
                    </label>

                    {{-- Link to login --}}
                    <p class="pb-account-link">
                        Already have an account? <a href="{{ route('login') }}">Log in</a>
                    </p>
                
                    {{-- Legal / privacy note --}}
                    <p class="pb-legal">
                        By submitting, you agree to hear from PackBack in line with our
                        <br><a href="{{ route('privacy-policy') }}">Privacy Policy</a>.
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