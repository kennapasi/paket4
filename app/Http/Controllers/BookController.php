<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // ETALASE: Dilihat oleh User & Admin
    public function index() {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    // ADMIN: Halaman tambah buku
    public function create() {
        return view('books.create');
    }

    // ADMIN: Proses simpan buku ke database
    public function store(Request $request) {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|integer',
            'stok' => 'required|integer'
        ]);

        Book::create($request->all());
        // UBAH: Arahkan ke admin.books.index
        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dipajang di etalase.');
    }

    // ADMIN: Halaman edit
    public function edit(Book $book) {
        return view('books.edit', compact('book'));
    }

    // ADMIN: Proses update
    public function update(Request $request, Book $book) {
        $request->validate([
            'judul' => 'required',
            'stok' => 'required|integer'
        ]);

        $book->update($request->all());
        // UBAH: Arahkan ke admin.books.index
        return redirect()->route('admin.books.index')->with('success', 'Data buku diperbarui.');
    }

    // ADMIN: Hapus buku
    public function destroy(Book $book) {
        $book->delete();
        // UBAH: Arahkan ke admin.books.index
        return redirect()->route('admin.books.index')->with('success', 'Buku ditarik dari etalase.');
    }

    // Tambahkan method ini untuk Tampilan Admin (Tabel)
    public function adminIndex() {
        $books = Book::all();
        return view('admin.books.index', compact('books')); // View khusus admin
    }
}
