<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();

        // Statistik khusus untuk user yang sedang login
        $totalBorrowed = Transaction::where('user_id', $userId)->count();
        $pendingReturns = Transaction::where('user_id', $userId)->where('status', 'borrowed')->count();

        // Ambil 3 transaksi terakhir milik user
        $recentTransactions = Transaction::with('book')
            ->where('user_id', $userId)
            ->latest()
            ->take(3)
            ->get();

        // return view('admin.dashboard', compact('totalBorrowed', 'pendingReturns', 'recentTransactions'));
        $users = \App\Models\User::where('role', 'peminjam')->get();
        return view('admin.users.index', compact('users'));
    }
    // Tambahkan method ini untuk Data Anggota
public function usersIndex() {
    $users = \App\Models\User::where('role', 'peminjam')->get();
    return view('admin.users.index', compact('users'));
}
}
