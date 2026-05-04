<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class OtpLoginController extends Controller
{
    public function verify2fa(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric'
        ]);

        $userId = auth()->id();
        $cachedOtp = Cache::get('email_otp_' . $userId);

        if ($cachedOtp && $cachedOtp == $request->otp) {
            // Success! Set session flag and clear cache.
            session(['otp_verified' => true]);
            Cache::forget('email_otp_' . $userId);

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['otp' => 'The OTP is invalid or has expired.']);
    }
}
