<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController; // Tambahan untuk Data Anggota

// 1. Landing Page & Auth
Route::get('/', function () { return view('welcome'); });
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 2. Middleware Auth
Route::middleware(['auth'])->group(function () {

    // --- AREA PUBLIC / USER ---
    // Etalase (Grid View)
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    // Tas Saya
    Route::get('/my-loans', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');

    // --- AREA ADMIN (Sidebar) ---
    Route::prefix('admin')->middleware('auth')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // 1. Kelola Buku (Tampilan Admin/Tabel)
        Route::get('/books-manage', [BookController::class, 'adminIndex'])->name('admin.books.index'); // Rute Baru

        // 2. Kelola Peminjaman
        Route::get('/transactions', [TransactionController::class, 'adminIndex'])->name('admin.transactions.index'); // Rute Baru
        Route::patch('/transactions/{transaction}/return', [TransactionController::class, 'returnBook'])->name('transactions.return');

        // 3. Kelola Anggota
        Route::get('/users', [AdminController::class, 'usersIndex'])->name('admin.users.index'); // Rute Baru

        // CRUD Buku (Logic Tetap)
        Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
        Route::post('/books', [BookController::class, 'store'])->name('books.store');
        Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
        Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
        Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
    });
});
