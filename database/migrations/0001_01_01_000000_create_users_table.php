<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('username')->unique(); // Untuk login sesuai flowchart [cite: 41, 53]
        $table->string('password');
        $table->string('email')->unique()->nullable(); // Opsional
        $table->string('nama_lengkap');
        $table->string('nis')->nullable(); // Nomor Induk Siswa (Khusus Anggota)
        $table->text('alamat')->nullable(); // Alamat Anggota [cite: 50]
        $table->enum('role', ['admin', 'peminjam']); // Pembeda hak akses [cite: 105]
        $table->rememberToken();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
