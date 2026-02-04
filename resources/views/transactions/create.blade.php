@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Catat Peminjaman Baru</h2>

    {{-- Tampilkan error jika stok habis atau validasi gagal --}}
    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf

        {{-- Pilih Peminjam (Siswa) --}}
        <div class="mb-4">
            <label class="block text-gray-700">Nama Peminjam (Siswa)</label>
            <select name="user_id" class="w-full border p-2 rounded" required>
                <option value="">-- Pilih Siswa --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Pilih Buku --}}
        <div class="mb-4">
            <label class="block text-gray-700">Pilih Buku</label>
            <select name="book_id" class="w-full border p-2 rounded" required>
                <option value="">-- Pilih Buku --</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}">
                        {{ $book->judul }} (Stok: {{ $book->stok }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tanggal Pinjam --}}
        <div class="mb-4">
            <label class="block text-gray-700">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" class="w-full border p-2 rounded" value="{{ date('Y-m-d') }}" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan Transaksi</button>
        <a href="{{ route('transactions.index') }}" class="text-gray-500 ml-3">Batal</a>
    </form>
</div>
@endsection
