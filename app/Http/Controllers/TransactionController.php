<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index() {
        // Ambil transaksi, urutkan dari yang terbaru
        $transactions = Transaction::with(['user', 'book'])->latest()->get();
        return view('transactions.index', compact('transactions'));
    }

    public function create() {
        $books = Book::where('stok', '>', 0)->get(); // Hanya buku yang ada stoknya
        $users = User::where('role', 'peminjam')->get(); // Hanya siswa
        return view('transactions.create', compact('books', 'users'));
    }

    public function store(Request $request) {
        $request->validate([
            'user_id' => 'required',
            'book_id' => 'required',
            'tanggal_pinjam' => 'required|date',
        ]);

        // Logika: Kurangi Stok Buku
        $book = Book::findOrFail($request->book_id);

        if($book->stok > 0){
            $book->decrement('stok'); // Kurangi 1 stok

            Transaction::create([
                'user_id' => $request->user_id,
                'book_id' => $request->book_id,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'status' => 'pinjam'
            ]);

            return redirect()->route('transactions.index')->with('success', 'Peminjaman berhasil dicatat.');
        } else {
            return back()->with('error', 'Stok buku habis!');
        }
    }

    // Fungsi untuk Mengembalikan Buku
    public function complete($id) {
        $transaction = Transaction::findOrFail($id);

        if($transaction->status == 'pinjam'){
            $transaction->update([
                'tanggal_kembali' => now(),
                'status' => 'kembali'
            ]);

            // Kembalikan Stok Buku
            $transaction->book->increment('stok');
        }

        return back()->with('success', 'Buku berhasil dikembalikan.');
    }
}
