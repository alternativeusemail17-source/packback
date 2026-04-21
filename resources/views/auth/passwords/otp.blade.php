@extends('layouts.app')

{{-- Page title --}}
@section('title', 'Verify OTP')

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
            <h2>Secure Your Account</h2>
            <p>
                Enter the OTP sent to your email to verify your identity and continue.
            </p>
        </div>
    </div>

    {{-- Right OTP verification panel --}}
    <div class="pb-panel">
        <div class="pb-panel-inner">

            {{-- Panel header --}}
            <p class="pb-kicker">Verify Your OTP</p>
            <h2 class="pb-form-heading">Enter OTP</h2>
            <p class="pb-panel-copy">
                We sent a one-time password (OTP) to your email: <strong>{{ maskEmail(old('email', $email)) }}</strong>. Enter it below to proceed.
            </p>

            {{-- OTP form --}}
            <form method="POST" action="{{ route('password.otp.verify') }}">
                @csrf
                <input type="hidden" name="email" value="{{ old('email', $email) }}">

                {{-- OTP input fields --}}
                <label class="pb-field pb-field-full">
                    <span>OTP <span aria-hidden="true">*</span></span>
                    <div class="flex gap-2 mt-2 justify-center">
                        @for ($i = 0; $i < 6; $i++)
                            <input 
                                type="text" 
                                maxlength="1" 
                                name="otp[]" 
                                class="otp-input w-12 h-12 text-center border border-gray-300 rounded-md focus:border-green-500 focus:ring-1 focus:ring-green-400 text-lg" 
                            >
                        @endfor
                    </div>
                </label>

                {{-- Display first error if any --}}
                @if ($errors->any())
                    <div class="pb-error pb-global-error">
                        {{ $errors->first() }}
                    </div>
                @endif

                {{-- Submit button --}}
                <button type="submit" class="pb-submit mt-4">Verify OTP</button>
            </form>

        </div>
    </div>

</div>

@endsection

{{-- Hero footer --}}
@section('hero-footer')
    @include('layouts.footer')
@endsection