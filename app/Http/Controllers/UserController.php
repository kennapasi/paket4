<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class UserController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();
        $totalBorrowed = Transaction::where('user_id', $userId)->count();
        $pendingReturns = Transaction::where('user_id', $userId)->where('status', 'borrowed')->count();
        $recentTransactions = Transaction::with('book')
            ->where('user_id', $userId)
            ->latest()
            ->take(3)
            ->get();

        // MENGARAH KE FOLDER USER
        return view('user.dashboard', compact('totalBorrowed', 'pendingReturns', 'recentTransactions'));
    }
}
