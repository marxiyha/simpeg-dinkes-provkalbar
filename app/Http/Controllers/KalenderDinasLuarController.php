<?php

namespace App\Http\Controllers;

// Pastikan namespace model ini sudah sesuai dengan nama file model aslimu (perhatikan huruf besar kecilnya)
use App\Models\kalenderDinasLuar; 
use Illuminate\Http\Request;

class KalenderDinasLuarController extends Controller
{
    // Menggunakan nama fungsi indexGlobal
    public function indexGlobal()
    {
        // Ambil semua data dinas luar menggunakan model yang tepat (kalenderDinasLuar)
        $dinasLuar = kalenderDinasLuar::with('user')->get();

        // Kirim variabel $dinasLuar ke file view kalender
        return view('dinasluar.kalender', compact('dinasLuar'));
    }

    // Fungsi rekapitulasi data dinas luar
    public function tampilRekap()
    {
        // Samakan panggilannya menggunakan model kalenderDinasLuar
        $dinasLuar = kalenderDinasLuar::with('user')->get();
        
        return view('dinasluar.rekap', compact('dinasLuar'));
    }
}