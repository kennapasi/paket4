<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
// USER: Tampilan Katalog Buku Khusus Siswa (Dengan Fitur Search)
    public function index(Request $request) {
        // Jika user mengetik sesuatu di kolom pencarian
        if ($request->has('search')) {
            $books = Book::where('judul', 'like', '%' . $request->search . '%')
                         ->orWhere('penulis', 'like', '%' . $request->search . '%')
                         ->get();
        } else {
            // Tampilkan semua jika tidak mencari
            $books = Book::latest()->get();
        }

        return view('user.books.index', compact('books'));
    }
    // ADMIN: Halaman tambah buku
    public function create() {
        return view('books.create');
    }

    // ADMIN: Proses simpan buku ke database (Upload Foto Baru)
    public function store(Request $request) {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|integer',
            'stok' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048' // Wajib foto
        ]);

        $data = $request->all();

        // Simpan foto ke folder public/storage/books
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('books', 'public');
        }

        Book::create($data);

        return redirect()->route('admin.books.index')->with('success', 'Buku dan foto berhasil ditambahkan.');
    }

    // ADMIN: Halaman edit
    public function edit(Book $book) {
        return view('books.edit', compact('book'));
    }

    // ADMIN: Proses update (Edit Foto Opsional)
    public function update(Request $request, Book $book) {
        $request->validate([
            'judul' => 'required',
            'stok' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' // Boleh dikosongkan saat edit
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Hapus foto lama jika ada
            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }
            // Simpan foto baru
            $data['image'] = $request->file('image')->store('books', 'public');
        }

        $book->update($data);

        return redirect()->route('admin.books.index')->with('success', 'Data buku diperbarui.');
    }

    // ADMIN: Hapus buku
    public function destroy(Book $book) {
        // Hapus juga file fotonya dari penyimpanan
        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }

        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Buku dan fotonya berhasil dihapus.');
    }
}
