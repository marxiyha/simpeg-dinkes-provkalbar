<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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