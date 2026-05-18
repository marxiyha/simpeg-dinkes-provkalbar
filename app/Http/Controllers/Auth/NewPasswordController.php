<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class NewPasswordController extends Controller
{
    public function create()
    {
        return view('auth.reset-password');
    }

    public function store(Request $request)
    {
        $request->validate([

            'email' => 'required|email',

            'password' => 'required|confirmed|min:6'

        ]);

        $user = User::where('email',$request->email)->first();

        if(!$user){

            return back()->withErrors([
                'email' => 'Email tidak ditemukan'
            ]);

        }

        $user->update([

            'password' => Hash::make($request->password)

        ]);

        return redirect()
            ->route('login')
            ->with('success','Password berhasil diubah');

    }
}