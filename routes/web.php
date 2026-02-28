<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;

// 1. Halaman Depan & Tamu
Route::get('/', function () { return view('welcome'); });

// Area Tamu (Belum Login)
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Register (Khusus User)
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// 2. Area Harus Login
Route::middleware(['auth'])->group(function () {

    // LOGOUT (Hanya bisa diakses kalau sudah login)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // --- AREA USER (PEMINJAM) ---
    // User dashboard & aktivitasnya
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/books', [BookController::class, 'index'])->name('books.index'); // Katalog User
    Route::get('/my-loans', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');

    // --- AREA KHUSUS ADMIN ---
    Route::prefix('admin')->middleware(['is_admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Manajemen Buku Admin
        Route::get('/books', [BookController::class, 'adminIndex'])->name('admin.books.index'); // Tabel Admin
        Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
        Route::post('/books', [BookController::class, 'store'])->name('books.store');
        Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
        Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
        Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

        // Manajemen Transaksi Admin
        Route::get('/transactions', [TransactionController::class, 'adminIndex'])->name('admin.transactions.index');
        Route::patch('/transactions/{transaction}/return', [TransactionController::class, 'returnBook'])->name('transactions.return');

        // Manajemen Anggota
        Route::get('/users', [AdminController::class, 'usersIndex'])->name('admin.users.index');
    });
});
