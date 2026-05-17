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
        // nanti bisa diganti database
        $cuti = [
            [
                'nama' => 'Budi Santoso',
                'mulai' => '2026-05-10',
                'selesai' => '2026-05-15',
                'bidang' => 'Keuangan',
                'status' => 'Pending',
            ],
            [
                'nama' => 'Dewi Kurnia',
                'mulai' => '2026-05-20',
                'selesai' => '2026-05-28',
                'bidang' => 'Pelayanan',
                'status' => 'Disetujui',
            ],
        ];

        return view('cuti.approval', compact('cuti'));
    }

    /*
    |--------------------------------------------------------------------------
    | HALAMAN REKAP CUTI
    |--------------------------------------------------------------------------
    */
    public function rekap(Request $request)
    {
        $tahun = $request->get('tahun', date('Y'));

        $data = [
            [
                'nama' => 'Budi Santoso',
                'mulai' => '2026-05-10',
                'selesai' => '2026-05-15',
                'bidang' => 'Keuangan',
                'status' => 'Disetujui',
            ],
            [
                'nama' => 'Dewi Kurnia',
                'mulai' => '2026-06-01',
                'selesai' => '2026-06-05',
                'bidang' => 'Pelayanan',
                'status' => 'Pending',
            ],
        ];

        return view('cuti.rekap', compact('data', 'tahun'));
    }
}