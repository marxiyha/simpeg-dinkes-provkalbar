<?php

namespace App\Exports;

use App\Models\PegawaiUPT;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UPTSheetExport implements FromCollection, WithTitle, WithHeadings, WithMapping
{
    private $unit;

    public function __construct(string $unit)
    {
        $this->unit = $unit;
    }

    /**
     * Mengambil data dari tabel PegawaiUPT berdasarkan unit yang dipilih.
     * Pastikan nama kolom di database Anda sesuai dengan yang ada di sini.
     */
    public function collection()
    {
        // PENTING: Jika error "Column not found" masih muncul, 
        // ganti 'upt_unit' di bawah ini dengan nama kolom yang benar 
        // (cek di database Anda, mungkin namanya 'unit' atau 'unit_kerja')
        return PegawaiUPT::where('upt_unit', $this->unit)->get();
    }

    /**
     * Memberikan judul sheet (maksimal 31 karakter untuk Excel).
     */
    public function title(): string
    {
        return substr($this->unit, 0, 31);
    }

    /**
     * Membuat header kolom di Excel.
     */
    public function headings(): array
    {
        return [
            'Nama', 
            'Email', 
            'NIP', 
            'Unit Kerja', 
            'Jabatan', 
            'Status Pegawai', 
            'Jenis Kelamin', 
            'Tanggal Lahir'
        ];
    }

    /**
     * Memetakan data dari database ke kolom Excel.
     * Sesuaikan nama properti ($row->...) dengan nama kolom di database Anda.
     */
    public function map($row): array
    {
        return [
            $row->nama_pegawai ?? '-',
            $row->email ?? '-',
            $row->nip ?? '-',
            $row->upt_unit ?? '-',
            $row->jabatan ?? '-',
            $row->status_pegawai ?? '-',
            $row->jenis_kelamin ?? '-',
            $row->tanggal_lahir ?? '-',
        ];
    }
}