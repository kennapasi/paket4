<?php
namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // USER: Tampilan Katalog
    public function index() {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    // ADMIN: Tampilan Tabel Kelola Buku
    public function adminIndex() {
        $books = Book::all();
        return view('admin.books.index', compact('books'));
    }

    public function create() {
        return view('books.create');
    }

    public function store(Request $request) {
        $request->validate([
            'judul' => 'required', 'penulis' => 'required', 'penerbit' => 'required',
            'tahun_terbit' => 'required|integer', 'stok' => 'required|integer'
        ]);
        Book::create($request->all());
        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Book $book) {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book) {
        $request->validate(['judul' => 'required', 'stok' => 'required|integer']);
        $book->update($request->all());
        return redirect()->route('admin.books.index')->with('success', 'Buku diperbarui.');
    }

    public function destroy(Book $book) {
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Buku dihapus.');
    }
}
