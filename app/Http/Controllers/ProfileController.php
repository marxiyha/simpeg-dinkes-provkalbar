<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * TAMPILKAN HALAMAN PROFILE
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * UPDATE PROFILE (nama, email, dll)
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $user->fill($request->validated());

        // jika email berubah → reset verifikasi
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')
            ->with('status', 'profile-updated');
    }

    /**
     * UPDATE PASSWORD
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        $user = $request->user();

        $user->password = Hash::make($request->password);
        $user->save();

        return Redirect::route('profile.edit')
            ->with('status', 'password-updated');
    }

    /**
     * HAPUS AKUN (SUDAH DISINKRONKAN DENGAN DASHBOARD)
     */
    public function destroy(Request $request): RedirectResponse
    {
        // validasi password sebelum hapus akun
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // logout user dulu
        Auth::logout();

        // hapus user dari database
        $user->delete();

        // amankan session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // redirect ke login
        return Redirect::to('/login');
    }
}