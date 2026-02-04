<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Transaction;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Hitung data untuk widget di dashboard
        // Gunakan '0' dulu jika model belum lengkap/ada
        $totalBooks = Book::count();
        $totalUsers = User::where('role', 'peminjam')->count();
        $activeLoans = Transaction::where('status', 'borrowed')->count();

        return view('admin.dashboard', compact('totalBooks', 'totalUsers', 'activeLoans'));
    }
}
