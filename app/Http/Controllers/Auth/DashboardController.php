<?php

namespace App\Http\Controllers;

use App\Models\FieldTask;
use App\Models\Leave;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPegawai = User::where('role', 'pegawai')->count();

        $cutiPending = Leave::where('status', 'pending')->count();

        $cutiDisetujui = Leave::where('status', 'approved')->count();

        $dinasLuar = FieldTask::where('status', 'active')->count();

        $latestActivities = Leave::latest()->take(5)->get();

        return view('dashboard.index', compact(
            'totalPegawai',
            'cutiPending',
            'cutiDisetujui',
            'dinasLuar',
            'latestActivities'
        ));
    }
}