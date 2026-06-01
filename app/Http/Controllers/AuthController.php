<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pegawai',
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function loginPetinggi(Request $request)
    {
        $request->validate(['email' => 'required|email', 'password' => 'required']);
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Email atau password salah.']);
        }

        if (! in_array($user->role, ['petinggi', 'superadmin', 'admin'])) {
            return back()->withErrors(['email' => 'Akses ditolak. Portal ini khusus untuk Petinggi dan Administrator.']);
        }

        $otp = random_int(100000, 999999);
        $user->update([
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        Log::info("OTP Petinggi untuk {$user->email}: {$otp}");

        Auth::logout();
        session([
            'otp_user_id' => $user->id,
            'otp_login_type' => 'blade',
            'login_portal' => 'petinggi',
        ]);

        return redirect()->route('otp.form');
    }

    public function loginPegawai(Request $request)
    {
        $request->validate(['email' => 'required|email', 'password' => 'required']);
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Email atau password salah.']);
        }

        if (! in_array($user->role, ['pegawai', 'operator'])) {
            return back()->withErrors(['email' => 'Akses ditolak. Portal ini khusus untuk Pegawai dan Operator.']);
        }

        $otp = random_int(100000, 999999);
        $user->update([
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        Log::info("OTP Pegawai untuk {$user->email}: {$otp}");

        Auth::logout();
        session([
            'otp_user_id' => $user->id,
            'otp_login_type' => 'react',
            'login_portal' => 'pegawai',
        ]);

        return redirect()->route('otp.form');
    }

    public function otpForm()
    {
        if (! session()->has('otp_user_id')) {
            return redirect()->route('login');
        }

        $type = session('otp_login_type', 'react');

        if ($type === 'blade') {
            return view('layouts.otp');
        }

        return Inertia::render('auth/verify-otp');
    }

    public function resendOtp()
    {
        $userId = session('otp_user_id');
        if (! $userId) {
            return redirect()->route('login');
        }

        $user = User::find($userId);
        $otp = random_int(100000, 999999);

        $user->update([
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        Log::info("OTP Baru untuk {$user->email}: {$otp}");

        return back()->with('success', 'Kode OTP baru telah dikirim.');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);
        $user = User::find(session('otp_user_id'));

        if (! $user || (string) $user->otp_code !== (string) $request->otp || now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'OTP salah atau kadaluwarsa.']);
        }

        $user->update(['otp_code' => null]);
        Auth::login($user);
        session()->forget(['otp_user_id', 'otp_login_type']);

        return redirect()->route('dashboard');
    }

    public function updatePassword(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email', 'password' => 'required|min:8|confirmed']);
        User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

        return redirect()->route('login')->with('success', 'Password berhasil diubah.');
    }

    public function logout(Request $request)
    {
        $portal = session('login_portal', 'pegawai');

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($portal === 'petinggi') {
            return redirect()->route('login.petinggi');
        }

        return redirect()->route('login');
    }
}
