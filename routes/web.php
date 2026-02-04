<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TransactionController;

// 1. Landing Page
Route::get('/', function () {
    return view('welcome');
});

// 2. Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 3. Protected Routes (Harus Login)
Route::middleware(['auth'])->group(function () {

    // Katalog Buku (Akses Umum setelah Login)
    Route::get('/books', [BookController::class, 'index'])->name('books.index');

    // Fitur Khusus Peminjam (Mencegah Admin meminjam buku sendiri jika ingin rapi)
    Route::get('/my-loans', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');

    // Admin Area (Ditambahkan proteksi tambahan)
    Route::prefix('admin')->group(function () {
        // Gunakan middleware custom jika sudah dibuat, atau cek manual di Controller
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Manajemen Buku (CRUD)
        Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
        Route::post('/books', [BookController::class, 'store'])->name('books.store');
        Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
        Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
        Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
    });
});
