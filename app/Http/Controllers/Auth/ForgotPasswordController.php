<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /**
     * Show email request form
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Show OTP verification form
     */
    public function showVerifyOTPPage(Request $request)
    {
        $email = $request->session()->get('email') ?? old('email');
        if (!$email) {
            return redirect()->route('password.request')
                             ->withErrors(['email' => 'Email is required to continue.']);
        }

        return view('auth.passwords.otp', compact('email'));
    }

    /**
     * Send OTP to the user
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $email = $request->email;
        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found']);
        }

        $otp = rand(100000, 999999);
        Cache::put('otp_'.$email, Hash::make($otp), now()->addMinutes(5));

        $user->notify(new \App\Notifications\PasswordResetOtp($otp));

        return redirect()->route('password.otp.form')->with('email', $email);
    }

    /**
     * Verify OTP
     */
    public function verifyOtp(Request $request)
    {
        $otp = implode('', $request->otp ?? []);
        $request->merge(['otp_combined' => $otp]);

        $request->validate([
            'email' => 'required|email',
            'otp_combined' => 'required|digits:6'
        ]);

        $storedOtp = Cache::get('otp_'.$request->email);

        if (!$storedOtp || !Hash::check($otp, $storedOtp)) {
            return back()
                ->withErrors(['otp' => 'Invalid or expired OTP'])
                ->withInput(['email' => $request->email]);
        }

        Cache::forget('otp_'.$request->email);

        $user = User::where('email', $request->email)->first();

        $token = Password::broker()->createToken($user);

        return redirect()->route('password.reset', [
            'token' => $token,
            'email' => $request->email
        ])->with('success', 'OTP verified! Please reset your password.');
    }
}