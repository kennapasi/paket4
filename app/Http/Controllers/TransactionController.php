<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // USER: Lihat riwayat pinjaman sendiri
    public function index() {
        $transactions = Transaction::with('book')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
        return view('transactions.index', compact('transactions'));
    }

    // USER: Proses Pinjam Buku
    public function store(Request $request) {
        $request->validate(['book_id' => 'required|exists:books,id']);

        $book = Book::findOrFail($request->book_id);

        // Validasi: Apakah stok masih ada?
        if ($book->stok <= 0) {
            return back()->with('error', 'Maaf, stok buku sedang habis.');
        }

        // Validasi: Apakah user masih meminjam buku yang sama dan belum dikembalikan?
        $alreadyBorrowed = Transaction::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->where('status', 'borrowed')
            ->exists();

        if ($alreadyBorrowed) {
            return back()->with('error', 'Anda masih meminjam buku ini dan belum mengembalikannya.');
        }

        // Buat Transaksi
        Transaction::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'tanggal_pinjam' => now(),
            'status' => 'borrowed'
        ]);

        // KURANGI STOK BUKU (-1)
        $book->decrement('stok');

        return redirect()->route('transactions.index')->with('success', 'Berhasil meminjam buku!');
    }

    // ADMIN: Lihat semua transaksi
    public function adminIndex() {
        $transactions = Transaction::with(['book', 'user'])->latest()->get();
        return view('admin.transactions.index', compact('transactions'));
    }

    // ADMIN: Proses Pengembalian Buku
    public function returnBook(Transaction $transaction) {
        if ($transaction->status === 'returned') {
            return back()->with('error', 'Buku ini sudah dikembalikan sebelumnya.');
        }

        // Ubah status dan catat tanggal kembali
        $transaction->update([
            'status' => 'returned',
            'tanggal_kembali' => now()
        ]);

        // TAMBAH STOK BUKU KEMBALI (+1)
        $transaction->book->increment('stok');

        return back()->with('success', 'Buku berhasil dikembalikan dan stok telah diupdate.');
    }
}
