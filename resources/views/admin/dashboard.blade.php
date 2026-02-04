@extends('layouts.admin')

@section('content')
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Dashboard</h2>
            <p class="text-gray-600">Selamat datang kembali, Admin!</p>
        </div>
        <div class="text-sm text-gray-500 bg-white px-4 py-2 rounded-lg shadow-sm">
            📅 {{ date('d F Y') }}
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-blue-500 flex items-center">
            <div class="p-3 bg-blue-100 rounded-full text-blue-600 mr-4">
                <i class="fas fa-book text-2xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Total Koleksi Buku</p>
                <h3 class="text-2xl font-bold">{{ $totalBooks ?? 0 }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-green-500 flex items-center">
            <div class="p-3 bg-green-100 rounded-full text-green-600 mr-4">
                <i class="fas fa-users text-2xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Anggota Terdaftar</p>
                <h3 class="text-2xl font-bold">{{ $totalUsers ?? 0 }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-purple-500 flex items-center">
            <div class="p-3 bg-purple-100 rounded-full text-purple-600 mr-4">
                <i class="fas fa-clock text-2xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Sedang Dipinjam</p>
                <h3 class="text-2xl font-bold">{{ $activeLoans ?? 0 }}</h3>
            </div>
        </div>

    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-lg font-bold mb-4">Aktivitas Terbaru</h3>
        <p class="text-gray-500 italic">Belum ada aktivitas transaksi.</p>
        </div>
@endsection
