@extends('layouts.admin')

@section('content')
<div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 max-w-2xl mx-auto">
    <div class="mb-6 border-b border-slate-100 pb-4">
        <h2 class="text-2xl font-bold text-slate-800">Tambah Buku Baru 📚</h2>
        <p class="text-slate-500 text-sm">Masukkan detail informasi buku ke dalam katalog perpustakaan.</p>
    </div>

    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-bold text-slate-700 mb-2">Judul Buku</label>
            <input type="text" name="judul" class="w-full border border-slate-200 p-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Contoh: Laskar Pelangi" required>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Penulis</label>
                <input type="text" name="penulis" class="w-full border border-slate-200 p-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none" required>
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Penerbit</label>
                <input type="text" name="penerbit" class="w-full border border-slate-200 p-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none" required>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Tahun Terbit</label>
                <input type="number" name="tahun_terbit" class="w-full border border-slate-200 p-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none" required>
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Stok Awal</label>
                <input type="number" name="stok" class="w-full border border-slate-200 p-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none" required>
            </div>
        </div>

        <div class="mb-8">
            <label class="block text-sm font-bold text-slate-700 mb-2">Foto Cover Buku (Wajib)</label>
            <input type="file" name="image" class="w-full border border-slate-200 p-2 rounded-xl text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*" required>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition-colors shadow-sm">
                <i class="fas fa-save mr-2"></i> Simpan Buku
            </button>
            <a href="{{ route('admin.books.index') }}" class="bg-slate-100 text-slate-600 px-6 py-3 rounded-xl font-bold hover:bg-slate-200 transition-colors">Batal</a>
        </div>
    </form>
</div>
@endsection
