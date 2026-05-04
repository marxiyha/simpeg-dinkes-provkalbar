<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;

class EnsureEmailOtpVerified
{
    public function handle(Request $request, Closure $next)
    {
        // Ensure user is actually logged in before checking OTP
        if (!auth()->check()) {
            return $next($request);
        }

        // If OTP is already verified in this session, allow request
        if (session('otp_verified') === true) {
            return $next($request);
        }

        // Generate and send OTP if not already sent recently
        $userId = auth()->id();
        if (!Cache::has('email_otp_' . $userId)) {
            $otp = rand(100000, 999999);
            Cache::put('email_otp_' . $userId, $otp, now()->addMinutes(5));
            Mail::to(auth()->user()->email)->send(new SendOtpMail($otp));
        }

        // Redirect to OTP challenge page
        return redirect()->route('otp.challenge');
    }
}
