<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;

// 1. Landing Page & Auth
Route::get('/', function () { return view('welcome'); });
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 2. Middleware Auth (Harus Login Dulu)
Route::middleware(['auth'])->group(function () {

    // --- AREA PUBLIC / USER (Bisa diakses user & admin) ---
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/my-loans', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');

    // --- AREA ADMIN (CUMA BOLEH ADMIN) ---
    // Perhatikan: Kita tambahkan 'is_admin' di sini
    Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Manajemen Buku
        Route::get('/books-manage', [BookController::class, 'adminIndex'])->name('admin.books.index');
        Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
        Route::post('/books', [BookController::class, 'store'])->name('books.store');
        Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
        Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
        Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

        // Manajemen Transaksi
        Route::get('/transactions', [TransactionController::class, 'adminIndex'])->name('admin.transactions.index');
        Route::patch('/transactions/{transaction}/return', [TransactionController::class, 'returnBook'])->name('transactions.return');

        // Manajemen User
        Route::get('/users', [AdminController::class, 'usersIndex'])->name('admin.users.index');
    });
});
