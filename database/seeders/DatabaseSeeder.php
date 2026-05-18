<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin Dinkes',
            'email' => 'admin@dinkes.kalbar.go.id',
            'password' => Hash::make('password123'),
            //admin
        ]);
         User::factory()->create([
            'name' => 'Pegawai Dinkes',
            'email' => 'pegawai@dinkes.kalbar.go.id',
            'password' => Hash::make('password123'),
            //user
        ]);
    }
}
