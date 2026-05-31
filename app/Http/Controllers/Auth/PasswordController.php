<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Illuminate\Validation\Rules;

use Illuminate\View\View;

class PasswordController extends Controller
{
    /**
     * Tampilkan halaman ubah password
     */

    public function edit(): View
    {
        return view('profile.password');
    }

    /**
     * Update password user
     */

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
            ],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with(
            'status',
            'password-updated'
        );
    }
}