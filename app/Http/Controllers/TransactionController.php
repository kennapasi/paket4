<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // USER: Lihat riwayat sendiri
    public function index() {
        $transactions = Transaction::with('book')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
        return view('transactions.index', compact('transactions'));
    }

    // USER: Mengajukan Pinjaman (Belum mengurangi stok)
    public function store(Request $request) {
        $request->validate(['book_id' => 'required|exists:books,id']);
        $book = Book::findOrFail($request->book_id);

        if ($book->stok <= 0) {
            return back()->with('error', 'Maaf, stok buku sedang habis.');
        }

        // Cek jika user sedang meminjam atau menunggu ACC untuk buku yang sama
        $pendingOrBorrowed = Transaction::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->whereIn('status', ['pending_pinjam', 'pinjam'])
            ->exists();

        if ($pendingOrBorrowed) {
            return back()->with('error', 'Anda sudah mengajukan atau sedang meminjam buku ini.');
        }

        Transaction::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'tanggal_pinjam' => now(),
            'status' => 'pending_pinjam' // Status baru: Menunggu ACC Admin
        ]);

        return redirect()->route('transactions.index')->with('success', 'Permintaan pinjam dikirim. Silakan hubungi admin untuk ambil buku.');
    }

    // ADMIN: Lihat semua antrean transaksi
    public function adminIndex() {
        $transactions = Transaction::with(['book', 'user'])->latest()->get();
        return view('admin.transactions.index', compact('transactions'));
    }

    // ADMIN: Proses ACC Pinjam / ACC Kembali
    public function updateStatus(Transaction $transaction, $newStatus) {
        // Jika Admin ACC Pinjam -> Baru Stok Berkurang
        if ($newStatus === 'pinjam' && $transaction->status === 'pending_pinjam') {
            if ($transaction->book->stok > 0) {
                $transaction->book->decrement('stok');
                $transaction->update(['status' => 'pinjam']);
                return back()->with('success', 'Peminjaman disetujui, stok buku berkurang.');
            }
            return back()->with('error', 'Gagal ACC, stok tiba-tiba habis.');
        }

        // Jika User balikin buku -> Admin tidak langsung ACC, tapi status jadi 'pending_kembali'
        // (Opsional: User bisa klik 'Kembalikan' di dashboard mereka untuk lapor sudah balikin)

        // Jika Admin ACC Kembali -> Stok Bertambah
        if ($newStatus === 'kembali' && $transaction->status === 'pinjam') {
            $transaction->update([
                'status' => 'kembali',
                'tanggal_kembali' => now()
            ]);
            $transaction->book->increment('stok');
            return back()->with('success', 'Buku telah diterima kembali, stok bertambah.');
        }

        return back()->with('error', 'Tindakan tidak valid.');
    }
}
