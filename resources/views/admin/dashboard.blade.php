@extends('layouts.admin')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h2 class="text-3xl font-bold text-slate-800">Dashboard Admin</h2>
        <p class="text-slate-500 mt-2">Ringkasan statistik perpustakaan hari ini.</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center">
        <div class="p-4 bg-blue-50 rounded-xl text-blue-600 mr-4">
            <i class="fas fa-book text-2xl"></i>
        </div>
        <div>
            <p class="text-slate-500 text-sm font-medium">Total Koleksi Buku</p>
            <h3 class="text-3xl font-bold text-slate-800">{{ $totalBooks ?? 0 }}</h3>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center">
        <div class="p-4 bg-emerald-50 rounded-xl text-emerald-600 mr-4">
            <i class="fas fa-users text-2xl"></i>
        </div>
        <div>
            <p class="text-slate-500 text-sm font-medium">Anggota Terdaftar</p>
            <h3 class="text-3xl font-bold text-slate-800">{{ $totalUsers ?? 0 }}</h3>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center">
        <div class="p-4 bg-amber-50 rounded-xl text-amber-600 mr-4">
            <i class="fas fa-hand-holding-heart text-2xl"></i>
        </div>
        <div>
            <p class="text-slate-500 text-sm font-medium">Sedang Dipinjam</p>
            <h3 class="text-3xl font-bold text-slate-800">{{ $activeLoans ?? 0 }}</h3>
        </div>
    </div>
</div>
@endsection
