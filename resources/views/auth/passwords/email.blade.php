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

        {{-- Left showcase column --}}
        <div class="pb-showcase">
            <div class="pb-photo-shell">
                {{-- Top badge --}}
                <div class="pb-badge pb-badge-top">
                    <strong>100%</strong>
                    <span>closet coverage</span>
                </div>

                {{-- Bottom badge --}}
                <div class="pb-badge pb-badge-bottom">
                    <strong>5x</strong>
                    <span>packing clarity</span>
                </div>
            </div>

            {{-- Copy block with headline and description --}}
            <div class="pb-copy-block">
                <h2>Raise the quality bar for every outfit you pack.</h2>
                <p>
                    Get a guided walkthrough of PackBack and see how it keeps every dress,
                    laundry cycle, and travel look in one clean flow.
                </p>
            </div>
        </div>

        {{-- Right forgot password panel --}}
        <div class="pb-panel">
            <div class="pb-panel-inner">
                
                {{-- Panel header --}}
                <p class="pb-kicker">Forgot Your Password</p>
                <h2 class="pb-form-heading">Reset Your Password</h2>
                <p class="pb-panel-copy">
                    Enter the email associated with your account, and we’ll send you OTP to reset your password.
                </p>

                {{-- Forgot password form --}}
                <form class="pb-form-grid-single" method="POST" action="{{ route('password.email') }}">
                    @csrf
                
                    {{-- Email input --}}
                    <label class="pb-field pb-field-full">
                        <span>Email<span aria-hidden="true">*</span></span>
                        <input type="email" name="email" autocomplete="email">
                    </label>

                    {{-- Display first error if any --}}
                    @if ($errors->any())
                        <div class="pb-error pb-global-error">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    {{-- Back to login link --}}
                    <p class="pb-account-link">
                        Back to login?
                        <a href="{{ route('login') }}">Login</a>
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