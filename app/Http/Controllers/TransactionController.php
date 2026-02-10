<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // Halaman riwayat peminjaman user
    public function index()
    {
        // Mengambil data peminjaman milik user yang sedang login
        $transactions = Transaction::where('user_id', Auth::id())
                        ->with('book')
                        ->latest()
                        ->get();

        return view('transactions.index', compact('transactions'));
    }

    public function adminIndex()
{
    // Mengambil semua transaksi, diurutkan dari yang terbaru
    $transactions = Transaction::with(['user', 'book'])->latest()->get();
    return view('admin.transactions.index', compact('transactions'));
}

// Tambahkan method ini jika belum ada (untuk tombol "Kembalikan"):
public function returnBook(Transaction $transaction)
{
    $transaction->update([
        'status' => 'returned',
        'returned_at' => now(),
    ]);

    // Kembalikan stok buku
    $transaction->book->increment('stok');

    return back()->with('success', 'Buku berhasil dikembalikan dan stok diperbarui.');
}

    // Proses Logika Peminjaman
    public function store(Request $request)
    {
        // 1. Validasi ID Buku
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        // 2. Cari Data Buku
        $book = Book::findOrFail($request->book_id);

        // 3. Cek Stok Buku
        if ($book->stok <= 0) {
            return back()->with('error', 'Maaf, stok buku ini sudah habis!');
        }

        // 4. Buat Transaksi Peminjaman
        Transaction::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'borrowed_at' => now(),
            'status' => 'borrowed' // Status awal dipinjam
        ]);

        // 5. Kurangi Stok Buku Otomatis
        $book->decrement('stok');

        // 6. Arahkan ke halaman riwayat dengan pesan sukses
        return redirect()->route('transactions.index')->with('success', 'Berhasil meminjam buku! Jangan lupa dikembalikan ya.');
    }
}
