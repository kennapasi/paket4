@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-slate-800">Katalog Buku 📚</h2>
        <p class="text-slate-500 mt-2">Pilih dan pinjam buku favoritmu dari koleksi kami.</p>
    </div>

    @if(session('success'))
    <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-6 rounded-r-lg" role="alert">
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r-lg" role="alert">
        {{ session('error') }}
    </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($books as $book)
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden flex flex-col hover:shadow-md transition-all duration-300">
            <div class="h-48 bg-gradient-to-br from-blue-50 to-indigo-50 flex items-center justify-center border-b border-slate-100">
                <i class="fas fa-book-open text-5xl text-blue-200"></i>
            </div>

            <div class="p-5 flex flex-col flex-grow">
                <span class="text-xs font-bold text-blue-600 mb-1 uppercase tracking-wider">{{ $book->penerbit }}</span>
                <h3 class="font-bold text-lg text-slate-800 mb-1 line-clamp-2" title="{{ $book->judul }}">{{ $book->judul }}</h3>
                <p class="text-sm text-slate-500 mb-4">{{ $book->penulis }} • {{ $book->tahun_terbit }}</p>

                <div class="mt-auto flex items-center justify-between pt-4 border-t border-slate-50">
                    <span class="text-xs font-bold px-3 py-1 rounded-full border {{ $book->stok > 0 ? 'bg-emerald-50 text-emerald-600 border-emerald-200' : 'bg-red-50 text-red-600 border-red-200' }}">
                        Stok: {{ $book->stok }}
                    </span>

                    @if($book->stok > 0)
                    <form action="{{ route('transactions.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-lg font-semibold transition-colors shadow-sm">
                            Pinjam
                        </button>
                    </form>
                    @else
                    <button disabled class="bg-slate-100 text-slate-400 text-sm px-4 py-2 rounded-lg font-semibold cursor-not-allowed">
                        Habis
                    </button>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white rounded-2xl border border-dashed border-slate-300 p-12 flex flex-col items-center justify-center text-center">
            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-folder-open text-2xl text-slate-400"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-700 mb-1">Belum Ada Buku</h3>
            <p class="text-slate-500">Admin belum menambahkan buku ke dalam katalog saat ini.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
