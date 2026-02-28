<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;

Route::get('/', function () { return view('welcome'); });

// Area Tamu (Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Area Harus Login
Route::middleware(['auth'])->group(function () {

    // ----------------------------------------------------
    // AREA USER (PEMINJAM)
    // ----------------------------------------------------
    // Catatan: Jika User coba akses halaman ini, boleh.
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    // Katalog & Transaksi User
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/my-loans', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');

    // ----------------------------------------------------
    // AREA ADMIN (Wajib pakai middleware is_admin)
    // ----------------------------------------------------
    Route::prefix('admin')->middleware(['is_admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Manajemen Buku (CRUD)
        Route::get('/books-manage', [BookController::class, 'adminIndex'])->name('admin.books.index');
        Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
        Route::post('/books', [BookController::class, 'store'])->name('books.store');
        Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
        Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
        Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

        // Manajemen Transaksi (Admin lihat semua & proses pengembalian)
        Route::get('/transactions', [TransactionController::class, 'adminIndex'])->name('admin.transactions.index');
        Route::patch('/transactions/{transaction}/return', [TransactionController::class, 'returnBook'])->name('transactions.return');

        // Manajemen User
        Route::get('/users', [AdminController::class, 'usersIndex'])->name('admin.users.index');
    });
});
