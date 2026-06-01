<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengajuanCutiController extends Controller
{
    public function index()
    {
        $cuti = \App\Models\Cuti::with('user.unitKerja')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('cuti.index', compact('cuti'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_cuti' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required'
        ]);

        \App\Models\Cuti::create([
            'user_id' => auth()->id(),
            'jenis_cuti' => $request->jenis_cuti,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'alasan' => $request->alasan,
            'status' => 'Pending',
        ]);

        return redirect()->back()->with('success', 'Pengajuan cuti berhasil dikirim');
    }
}