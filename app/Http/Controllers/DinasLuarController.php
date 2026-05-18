<?php

namespace App\Http\Controllers;

use App\Models\DinasLuar;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DinasLuarController extends Controller
{
    public function index(Request $request)
    {
        $riwayatDinas = DinasLuar::where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('user/dinas-luar', [
            'riwayatDinas' => $riwayatDinas
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_dinas' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_dinas',
            'tujuan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        DinasLuar::create([
            'user_id' => $request->user()->id,
            'tanggal_dinas' => $request->tanggal_dinas,
            'tanggal_selesai' => $request->tanggal_selesai,
            'tujuan' => $request->tujuan,
            'keterangan' => $request->keterangan,
            'status' => 'Menunggu',
        ]);

        return redirect()->back()->with('success', 'Pengajuan dinas luar berhasil dikirim.');
    }
}
