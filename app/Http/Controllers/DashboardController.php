<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
}
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user()->load('unitKerja');

        return Inertia::render('user/dashboard', [
            'auth' => [
                'user' => $user,
            ],
        ]);
    }
}
