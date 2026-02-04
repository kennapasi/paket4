<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Menampilkan daftar buku untuk Peminjam & Admin
    public function index() {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    // Menampilkan form tambah buku (Hanya Admin)
    public function create() {
        return view('books.create');
    }

    // Menyimpan buku baru ke database
    public function store(Request $request) {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|integer',
            'stok' => 'required|integer'
        ]);

        Book::create($request->all());

        // PERBAIKAN: Gunakan redirect ke route index agar data ter-refresh
        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan');
    }

    // Menampilkan form edit buku
    public function edit(Book $book) {
        return view('books.edit', compact('book'));
    }

    // Memperbarui data buku
    public function update(Request $request, Book $book) {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|integer',
            'stok' => 'required|integer'
        ]);

        $book->update($request->all());
        return redirect()->route('books.index')->with('success', 'Buku berhasil diupdate');
    }

    // Menghapus buku
    public function destroy(Book $book) {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus');
    }
}
