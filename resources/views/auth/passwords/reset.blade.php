@extends('layouts.app')

{{-- Page title --}}
@section('title', 'Reset Password')

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
            <h2>Reset Your Password</h2>
            <p>
                Enter a new password to secure your account and continue using PackBack.
            </p>
        </div>
    </div>

    {{-- Right password reset panel --}}
    <div class="pb-panel">
        <div class="pb-panel-inner">

            {{-- Panel header --}}
            <p class="pb-kicker">Set a New Password</p>
            <h2 class="pb-form-heading">Reset Password</h2>

            {{-- Panel description --}}
            <p class="pb-panel-copy">
                Please reset the password for <strong>{{ $email }}</strong>
            </p>

            {{-- Password reset form --}}
            <form class="pb-form-grid-single" method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                {{-- New password field --}}
                <label class="pb-field pb-field-full">
                    <span>New Password<span aria-hidden="true">*</span></span>
                    <input type="password" name="password" id="password" autocomplete="new-password" required>
                    <div id="password-strength-bar">
                        <div id="password-strength-fill"></div>
                    </div>
                </label>

                {{-- Confirm password field --}}
                <label class="pb-field pb-field-full">
                    <span>Confirm Password<span aria-hidden="true">*</span></span>
                    <input type="password" name="password_confirmation" required>
                </label>

                {{-- Display first validation error if any --}}
                @if ($errors->any())
                    <div class="pb-error pb-global-error">
                        {{ $errors->first() }}
                    </div>
                @endif

                {{-- Submit button --}}
                <button type="submit" class="pb-submit mt-4">Reset Password</button>
            </form>

        </div>
    </div>

</div>

@endsection

{{-- Hero footer --}}
@section('hero-footer')
    @include('layouts.footer')
@endsection