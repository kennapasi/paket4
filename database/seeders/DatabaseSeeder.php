<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Admin Utama
        User::create([
            'name' => 'Administrator',
            'username' => 'admin', // Login pakai ini
            'email' => 'admin@sekolah.com', // Atau ini
            'password' => Hash::make('password123'), // Password
            'role' => 'admin',
        ]);

        // 2. Buat Akun Siswa Dummy (Buat ngetes nanti)
        User::create([
            'name' => 'Siswa Contoh',
            'username' => 'siswa01',
            'email' => 'siswa@sekolah.com',
            'password' => Hash::make('password123'),
            'role' => 'peminjam',
            'nis' => '12345678',    
        ]);

        // Nanti kita tambah seed buku & kategori di sini
    }
}
