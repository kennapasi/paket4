@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-6 border-b border-slate-50 flex justify-between items-center">
        <h3 class="font-bold text-slate-800 text-xl">Kelola Katalog Buku</h3>
        <a href="{{ route('books.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors shadow-sm">
            <i class="fas fa-plus mr-2"></i> Tambah Buku Baru
        </a>
    </div>

    <div class="px-6 pt-4">
        @if(session('success'))
            <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-r-lg mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="p-6 overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-slate-400 text-sm uppercase tracking-wider border-b border-slate-100">
                    <th class="pb-4 px-4 font-semibold">Buku</th>
                    <th class="pb-4 px-4 font-semibold">Penulis & Penerbit</th>
                    <th class="pb-4 px-4 font-semibold text-center">Tahun</th>
                    <th class="pb-4 px-4 font-semibold text-center">Stok</th>
                    <th class="pb-4 px-4 font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($books as $book)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="py-4 px-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-16 bg-slate-100 rounded overflow-hidden flex-shrink-0 border border-slate-200">
                                @if($book->image)
                                    <img src="{{ asset('storage/' . $book->image) }}" alt="Cover" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fas fa-book text-slate-300"></i>
                                    </div>
                                @endif
                            </div>
                            <span class="font-bold text-slate-700">{{ $book->judul }}</span>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <p class="text-slate-700 font-medium">{{ $book->penulis }}</p>
                        <p class="text-slate-400 text-xs">{{ $book->penerbit }}</p>
                    </td>
                    <td class="py-4 px-4 text-center text-slate-600">{{ $book->tahun_terbit }}</td>
                    <td class="py-4 px-4 text-center">
                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $book->stok > 0 ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-600' }}">
                            {{ $book->stok }}
                        </span>
                    </td>
                    <td class="py-4 px-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('books.edit', $book->id) }}" class="bg-amber-100 text-amber-600 hover:bg-amber-200 px-3 py-2 rounded-lg text-xs font-bold transition-colors">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-100 text-red-600 hover:bg-red-200 px-3 py-2 rounded-lg text-xs font-bold transition-colors" onclick="return confirm('Yakin ingin menghapus buku ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-8 text-center text-slate-500 italic">Belum ada buku di perpustakaan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
