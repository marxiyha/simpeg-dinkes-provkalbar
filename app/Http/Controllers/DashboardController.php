<?php

namespace App\Http\Controllers;

use App\Models\KalenderDinasLuar;
use App\Models\PegawaiDinkes;
use App\Models\PegawaiUPT;
use App\Models\PengajuanCuti;
use App\Models\UserManagement;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (! $user) {
            return redirect()->route('login');
        }

        // Blade dashboard for Petinggi and Super Admin
        if (in_array($user->role, ['petinggi', 'superadmin'])) {
            return view('dashboard', [
                'dinkes' => PegawaiDinkes::count(),
                'upt' => PegawaiUPT::count(),
                'cuti' => PengajuanCuti::count(),
                'kalender' => KalenderDinasLuar::count(),
                'users' => UserManagement::count(),
            ]);
        }

        // React dashboard for Admin
        if ($user->role === 'admin') {
            return Inertia::render('admin/dashboard');
        }

        // React dashboard for Pegawai/Operator
        return Inertia::render('user/dashboard');
    }
}
