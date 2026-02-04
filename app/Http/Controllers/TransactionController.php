<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index() {
        $transactions = Transaction::where('user_id', Auth::id())->with('book')->latest()->get();
        return view('transactions.index', compact('transactions'));
    }

    public function store(Request $request) {
        $book = Book::findOrFail($request->book_id);

        if ($book->stok <= 0) {
            return back()->with('error', 'Stok buku habis!');
        }

        Transaction::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'borrowed_at' => now(),
            'status' => 'borrowed'
        ]);

        $book->decrement('stok'); // Kurangi stok di database

        return redirect()->route('transactions.index')->with('success', 'Buku berhasil dipinjam!');
    }
}
