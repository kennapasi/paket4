@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl p-8 mb-8 text-white shadow-xl">
        <h2 class="text-3xl font-bold">Halo, {{ Auth::user()->name }}! 👋</h2>
        <p class="opacity-80 mt-2">Sudahkah Anda membaca buku hari ini? Temukan koleksi menarik lainnya di katalog.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center">
            <div class="p-4 bg-blue-50 rounded-xl text-blue-600 mr-4">
                <i class="fas fa-book-reader text-2xl"></i>
            </div>
            <div>
                <p class="text-slate-500 text-sm font-medium">Total Buku Pernah Dipinjam</p>
                <h3 class="text-3xl font-bold text-slate-800">
                    {{ $totalBorrowed }}

                </h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center">
            <div class="p-4 bg-amber-50 rounded-xl text-amber-600 mr-4">
                <i class="fas fa-hourglass-half text-2xl"></i>
            </div>
            <div>
                <p class="text-slate-500 text-sm font-medium">Buku Masih Dipinjam</p>
                <h3 class="text-3xl font-bold text-slate-800">
                    {{ $pendingReturns }}

                </h3>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-50 flex justify-between items-center">
            <h3 class="font-bold text-slate-800">Aktivitas Terakhir Saya</h3>
            <a href="{{ route('transactions.index') }}" class="text-blue-600 text-sm font-semibold hover:underline">Lihat Semua</a>
        </div>
        <div class="p-6">
             @forelse($recentTransactions as $trx)
                <div class="flex items-center justify-between py-3 border-b border-slate-50 last:border-0">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-14 bg-slate-200 rounded-md overflow-hidden flex-shrink-0">
                            <div class="w-full h-full flex items-center justify-center bg-slate-100">
                                <i class="fas fa-book text-slate-400"></i>
                            </div>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800">{{ $trx->book->title }}</p>
                            <p class="text-xs text-slate-500">{{ $trx->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $trx->status == 'borrowed' ? 'bg-amber-100 text-amber-600' : 'bg-emerald-100 text-emerald-600' }}">
                        {{ $trx->status == 'borrowed' ? 'Dipinjam' : 'Dikembalikan' }}
                    </span>
                </div>
            @empty
                <p class="text-center text-slate-400 py-4 italic">Belum ada riwayat peminjaman.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
