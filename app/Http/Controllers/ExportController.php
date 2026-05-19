<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

// Exports
use App\Exports\PegawaiExport;
use App\Exports\CutiExport;
use App\Exports\KalenderExport;
use App\Exports\RekapExport;

class ExportController extends Controller
{
    public function index()
    {
        return view('export.index');
    }

    public function pegawaiExcel()
    {
        return Excel::download(new PegawaiExport, 'data_pegawai_' . date('Y-m-d') . '.xlsx');
    }

    public function pegawaiPdf()
    {
        $data['pegawai'] = User::all();

        $pdf = Pdf::loadView('export.pdf.pegawai', $data);
        return $pdf->download('data_pegawai_' . date('Y-m-d') . '.pdf');
    }

    public function cutiExcel()
    {
        return Excel::download(new CutiExport, 'data_cuti_' . date('Y-m-d') . '.xlsx');
    }

    public function cutiPdf()
    {
        $data['cuti'] = User::all();

        $pdf = Pdf::loadView('export.pdf.cuti', $data);
        return $pdf->download('data_cuti_' . date('Y-m-d') . '.pdf');
    }

    public function kalenderExcel()
    {
        return Excel::download(new KalenderExport, 'kalender_' . date('Y-m-d') . '.xlsx');
    }

    public function kalenderPdf()
    {
        $data['kalender'] = User::all();

        $pdf = Pdf::loadView('export.pdf.kalender', $data);
        return $pdf->download('kalender_' . date('Y-m-d') . '.pdf');
    }

    public function rekapExcel()
    {
        return Excel::download(new RekapExport, 'rekap_' . date('Y-m-d') . '.xlsx');
    }

    public function rekapPdf()
    {
        $data['rekap'] = User::all();

        $pdf = Pdf::loadView('export.pdf.rekap', $data);
        return $pdf->download('rekap_' . date('Y-m-d') . '.pdf');
    }
}