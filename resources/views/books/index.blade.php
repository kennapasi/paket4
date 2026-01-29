@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Daftar Buku</h1>
    <a href="{{ route('books.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        + Tambah Buku
    </a>
</div>

<div class="bg-white shadow-md rounded my-6 overflow-x-auto">
    <table class="min-w-full bg-white grid-cols-1">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="py-3 px-4 text-left">Judul</th>
                <th class="py-3 px-4 text-left">Penulis</th>
                <th class="py-3 px-4 text-left">Stok</th>
                <th class="py-3 px-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @foreach($books as $book)
            <tr class="border-b">
                <td class="py-3 px-4">{{ $book->judul }}</td>
                <td class="py-3 px-4">{{ $book->penulis }}</td>
                <td class="py-3 px-4 font-bold">{{ $book->stok }}</td>
                <td class="py-3 px-4 text-center">
                    <a href="{{ route('books.edit', $book->id) }}" class="text-blue-500 hover:text-blue-800 mr-2">Edit</a>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-800" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
