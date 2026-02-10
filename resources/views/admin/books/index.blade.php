@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">📚 Kelola Koleksi Buku</h2>
    <a href="{{ route('books.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 shadow">
        <i class="fas fa-plus mr-2"></i> Tambah Buku
    </a>
</div>

@if(session('success'))
<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-bold">
            <tr>
                <th class="px-6 py-4">Judul Buku</th>
                <th class="px-6 py-4">Penulis</th>
                <th class="px-6 py-4 text-center">Stok</th>
                <th class="px-6 py-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($books as $book)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-semibold text-gray-800">{{ $book->judul }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $book->penulis }}</td>
                <td class="px-6 py-4 text-center">
                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $book->stok > 0 ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                        {{ $book->stok }}
                    </span>
                </td>
                <td class="px-6 py-4 text-center flex justify-center gap-2">
                    <a href="{{ route('books.edit', $book->id) }}" class="text-yellow-500 hover:text-yellow-600"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Hapus buku ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:text-red-600"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center py-6 text-gray-400">Belum ada buku.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
