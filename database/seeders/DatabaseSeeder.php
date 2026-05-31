<?php

namespace Database\Seeders;

<<<<<<< HEAD
use Illuminate\Database\Seeder;
use App\Models\User;
=======
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
>>>>>>> bb0a2cd02c3ec4a9a481080e2fa3e36501776e74
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Kepala',
            'username' => 'kepala',
            'email' => 'dinkes@kalbarprov.go.id',
            'password' => Hash::make('password'),
            'role' => 'petinggi',
        ]);

        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@kalbarprov.go.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
    }
}
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UnitKerjaSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Operator Dinkes',
            'email' => 'operator@dinkes.kalbar.go.id',
            'password' => Hash::make('password123'),
            'role' => 'operator',
            'nip' => '198803152015031001',
            'id_unit' => 1,
            'tanggal_lahir' => '1988-03-15',
            'jenis_kelamin' => 'Laki-laki',
            'pendidikan_terakhir' => 'S1 Sistem Informasi',
            'jabatan' => 'Pelaksana / Staf',
            'status_pegawai' => 'PNS',
            'tmt_pegawai' => '2015-03-01',
            'batas_usia_pensiun' => 58,
            'tmt_pensiun' => '2046-04-01',
            'perkiraan_naik_jabatan' => '2019, 2023, 2027',
            'perkiraan_naik_gaji' => '2017, 2019, 2021, 2023, 2025, 2027, 2029',
        ]);
        User::factory()->create([
            'name' => 'Pegawai Dinkes',
            'email' => 'pegawai@dinkes.kalbar.go.id',
            'password' => Hash::make('password123'),
            'role' => 'pegawai',
            'nip' => '199508122020121002',
            'id_unit' => 1,
            'tanggal_lahir' => '1995-08-12',
            'jenis_kelamin' => 'Laki-laki',
            'pendidikan_terakhir' => 'S1 Kesehatan Masyarakat',
            'jabatan' => 'Pelaksana / Staf',
            'status_pegawai' => 'PNS',
            'tmt_pegawai' => '2020-12-01',
            'batas_usia_pensiun' => 58,
            'tmt_pensiun' => '2053-09-01',
            'perkiraan_naik_jabatan' => '2024, 2028',
            'perkiraan_naik_gaji' => '2022, 2024, 2026, 2028',
        ]);
    }
}
