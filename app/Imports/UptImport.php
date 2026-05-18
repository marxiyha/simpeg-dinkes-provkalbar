<?php

namespace App\Imports;

use App\Models\PegawaiUPT;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DinkesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        /*
        |--------------------------------------------------------------------------
        | SKIP DATA KOTOR BKD
        |--------------------------------------------------------------------------
        */

        if (
            empty($row['nip']) ||
            str_contains(strtolower($row['nip']), 'daftar') ||
            str_contains(strtolower($row['nip']), 'unit') ||
            str_contains(strtolower($row['nip']), 'keadaan') ||
            strlen($row['nip']) < 3
        ) {
            return null;
        }

        return new PegawaiUPT([

            'nip' => $row['nip'] ?? null,

            'nama_pegawai' =>
                $row['nama_pegawai']
                ?? $row['nama_lengkap']
                ?? $row['nama']
                ?? '-',

            'jenis_kelamin' => $row['jenis_kelamin'] ?? '-',

            'pendidikan' => $row['pendidikan'] ?? '-',

            'jabatan' => $row['jabatan'] ?? '-',

            'status_pegawai' => $row['status_pegawai'] ?? 'Pegawai',

            'tmt_pensiun' => $row['tmt_pensiun'] ?? null,

            'batas_usia_pensiun' => $row['batas_usia_pensiun'] ?? null,

            'prediksi_naik_gaji' => $row['prediksi_naik_gaji'] ?? null,

            'prediksi_naik_pangkat' => $row['prediksi_naik_pangkat'] ?? null,

        ]);
    }
}