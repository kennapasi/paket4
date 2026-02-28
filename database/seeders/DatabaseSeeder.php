<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Mengecek apakah admin sudah ada agar tidak error duplicate saat di-seed ulang
        $admin = User::where('email', 'admin@perpusku.com')->first();

        if (!$admin) {
            User::create([
                'name' => 'Super Admin',
                'email' => 'admin@perpusku.com',
                'password' => Hash::make('admin123'), // Password default admin
                'role' => 'admin',
            ]);
        }
    }
}
