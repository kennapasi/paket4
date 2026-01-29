<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\TransactionController;

// Halaman Depan (Login)
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Group Middleware agar hanya yang sudah login bisa akses
Route::middleware(['auth'])->group(function () {

    // Dashboard (Bisa diakses admin & siswa, nanti di view dibedakan menunya)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Route Khusus Admin
    Route::middleware(['checkRole:admin'])->group(function () {
        Route::resource('books', BookController::class);
        Route::resource('transactions', TransactionController::class);
        // Route khusus untuk tombol "Kembalikan Buku"
        Route::patch('/transactions/{id}/complete', [TransactionController::class, 'complete'])->name('transactions.complete');
    });
});
