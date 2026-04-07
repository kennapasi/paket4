@extends('layouts.app') @section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6">
        <form action="{{ route('books.index') }}" method="GET" class="flex gap-2">
            <div class="relative flex-1 max-w-md">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-slate-400"></i>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul buku atau penulis..." class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none shadow-sm text-sm">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-5 py-3 rounded-xl font-bold hover:bg-blue-700 transition shadow-sm text-sm">Cari</button>
            @if(request('search'))
                <a href="{{ route('books.index') }}" class="bg-slate-200 text-slate-600 px-5 py-3 rounded-xl font-bold hover:bg-slate-300 transition shadow-sm text-sm">Reset</a>
            @endif
        </form>
    </div>
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-slate-800">Katalog Buku </h2>
        <p class="text-slate-500 mt-2">Jelajahi koleksi buku kami dan pinjam buku favoritmu.</p>
    </div>

    @if(session('success'))
        <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($books as $book)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-md transition-shadow flex flex-col">
                <div class="h-48 bg-slate-100 flex items-center justify-center overflow-hidden">
                    @if($book->image)
                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->judul }}" class="w-full h-full object-cover">
                    @else
                        <i class="fas fa-book-open text-5xl text-slate-300"></i>
                    @endif
                </div>

                <div class="p-5 flex-1 flex flex-col">
                    <h3 class="font-bold text-lg text-slate-800 mb-1 leading-tight">{{ $book->judul }}</h3>
                    <p class="text-sm text-slate-500 mb-3">{{ $book->penulis }}</p>

                    <div class="mt-auto">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-xs font-semibold px-2 py-1 bg-slate-100 text-slate-600 rounded">
                                {{ $book->tahun_terbit }}
                            </span>
                            <span class="text-xs font-bold {{ $book->stok > 0 ? 'text-emerald-600' : 'text-red-500' }}">
                                Stok: {{ $book->stok }}
                            </span>
                        </div>

                        <form action="{{ route('transactions.store') }}" method="POST" class="w-full">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            @if($book->stok > 0)
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg text-sm font-bold transition-colors">
                                    Pinjam Buku
                                </button>
                            @else
                                <button type="button" disabled class="w-full bg-slate-200 text-slate-400 py-2 rounded-lg text-sm font-bold cursor-not-allowed">
                                    Stok Habis
                                </button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center text-slate-400 bg-white rounded-2xl border border-slate-100 border-dashed">
                <i class="fas fa-box-open text-4xl mb-3"></i>
                <p>Belum ada koleksi buku saat ini.</p>
            </div>
            <div class="mb-6">
        <form action="{{ route('books.index') }}" method="GET" class="flex gap-2">
            <div class="relative flex-1 max-w-md">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-slate-400"></i>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul buku atau penulis..." class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none shadow-sm text-sm">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-5 py-3 rounded-xl font-bold hover:bg-blue-700 transition shadow-sm text-sm">Cari</button>
            @if(request('search'))
                <a href="{{ route('books.index') }}" class="bg-slate-200 text-slate-600 px-5 py-3 rounded-xl font-bold hover:bg-slate-300 transition shadow-sm text-sm">Reset</a>
            @endif
        </form>
    </div>
        @endforelse
    </div>
</div>
@endsection
