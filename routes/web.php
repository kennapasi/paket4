<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AdminController;

// 1. Halaman Depan (Loading Page)
Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->prefix('admin')->group(function () {

    // Dashboard Admin

    // Nanti rute buku & kategori taruh di sini...
    });
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// 2. Rute untuk Login & Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // Menampilkan Form
Route::post('/login', [AuthController::class, 'login']); // Proses Login
Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // Proses Logout

// 3. Rute Sementara (Untuk test setelah login)
// Nanti kita rapikan lagi saat masuk fitur Admin/Peminjam
Route::get('/books', [BookController::class, 'index'])->name('books.index')->middleware('auth');
Route::get('/books', [BookController::class, 'create'])->name('books.create')->middleware('auth');
Route::post('/books', [BookController::class, 'store'])->name('books.store')->middleware('auth');
Route::get('/admin/dashboard', function(){
    return "Halo Admin! Ini Dashboard kamu."; // Sementara teks dulu

})->middleware('auth');
