<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CutiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN APPROVAL CUTI
    |--------------------------------------------------------------------------
    */
    public function approval()
    {
        if (!session()->has('cuti_data')) {
            session([
                'cuti_data' => [
                    [
                        'id' => 1,
                        'nama' => 'Budi Santoso',
                        'bidang' => 'Keuangan',
                        'jenis_cuti' => 'Cuti Tahunan',
                        'tanggal_mulai' => '2026-05-10',
                        'tanggal_selesai' => '2026-05-15',
                        'alasan_cuti' => 'Acara pernikahan keluarga',
                        'status' => 'Pending',
                    ],
                    [
                        'id' => 2,
                        'nama' => 'Dewi Kurnia',
                        'bidang' => 'Pelayanan',
                        'jenis_cuti' => 'Cuti Besar',
                        'tanggal_mulai' => '2026-05-20',
                        'tanggal_selesai' => '2026-06-03',
                        'alasan_cuti' => 'Ibadah umroh',
                        'status' => 'Disetujui',
                    ],
                    [
                        'id' => 3,
                        'nama' => 'Andi Saputra',
                        'bidang' => 'Administrasi',
                        'jenis_cuti' => 'Cuti Sakit',
                        'tanggal_mulai' => '2026-06-01',
                        'tanggal_selesai' => '2026-06-03',
                        'alasan_cuti' => 'Sakit DBD',
                        'status' => 'Pending',
                    ],
                ]
            ]);
        }

        $cuti = session('cuti_data');

        return view('cuti.approval', compact('cuti'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE STATUS CUTI
    |--------------------------------------------------------------------------
    */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $cuti = session('cuti_data', []);

        foreach ($cuti as &$item) {
            if ($item['id'] == $id) {
                $item['status'] = $request->status;
            }
        }

        session(['cuti_data' => $cuti]);

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | REKAP CUTI
    |--------------------------------------------------------------------------
    */
    public function rekap(Request $request)
    {
        $tahun = $request->get('tahun', date('Y'));
        $data = session('cuti_data', []);

        $filtered = array_filter($data, function ($item) use ($tahun) {
            return date('Y', strtotime($item['tanggal_mulai'])) == $tahun;
        });

        return view('cuti.rekap', [
            'data' => $filtered,
            'tahun' => $tahun
        ]);
    }
}