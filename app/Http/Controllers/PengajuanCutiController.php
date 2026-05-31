<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengajuanCutiController extends Controller
{
    public function index()
    {
        if (!session()->has('cuti_data')) {
            session([
                'cuti_data' => []
            ]);
        }

        return view('cuti.index', [
            'cuti' => session('cuti_data')
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'bidang' => 'required',
            'jenis_cuti' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan_cuti' => 'required'
        ]);

        $cuti = session('cuti_data', []);

        $newId = count($cuti) > 0 ? max(array_column($cuti, 'id')) + 1 : 1;

        $cuti[] = [
            'id' => $newId,
            'nama' => $request->nama,
            'bidang' => $request->bidang,
            'jenis_cuti' => $request->jenis_cuti,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'alasan_cuti' => $request->alasan_cuti,
            'status' => 'Pending',
        ];

        session(['cuti_data' => $cuti]);

        return redirect()->back()->with('success', 'Pengajuan berhasil dikirim');
    }
}