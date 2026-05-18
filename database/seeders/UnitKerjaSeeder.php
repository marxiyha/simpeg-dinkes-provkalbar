<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UnitKerja;

class UnitKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            'Dinas Kesehatan Provinsi',
            'UPT Laboratorium Kesehatan Daerah',
            'UPT RSUD Daerah',
            'Bidang Pelayanan Kesehatan',
            'Bidang Kesehatan Masyarakat',
            'Bidang Pencegahan dan Pengendalian Penyakit'
        ];

        foreach ($units as $unit) {
            UnitKerja::firstOrCreate([
                'nama_unit' => $unit
            ]);
        }
    }
}
