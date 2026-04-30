<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Package;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Users
        User::create([
            'name' => 'Admin',
            'email' => 'admin@kampungadatbajulan.my.id',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Pengelola',
            'email' => 'pengelola@kampungadatbajulan.my.id',
            'password' => Hash::make('pengelola123'),
            'role' => 'pengelola',
        ]);

        // Packages
        Package::create([
            'name' => 'Paket Soan',
            'description' => 'Paket wisata soan ke Kampung Adat Bajulan',
            'price_per_person' => 75000,
            'min_person' => 5,
            'category' => 'kampung_adat',
        ]);

        Package::create([
            'name' => 'Edukasi Durian',
            'description' => 'Paket wisata edukasi berkebun dan makan durian lokal',
            'price_per_person' => 50000,
            'min_person' => 1,
            'category' => 'edukasi_durian',
        ]);

        Package::create([
            'name' => 'Pendakian',
            'description' => 'Paket wisata pendakian dan berkemah di alam Bajulan',
            'price_per_person' => 100000,
            'min_person' => 3,
            'category' => 'pendakian',
        ]);
    }
}
