@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Transaksi Peminjaman</h1>
    <a href="{{ route('transactions.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
        + Catat Peminjaman
    </a>
</div>

<div class="bg-white shadow-md rounded my-6 overflow-x-auto">
    <table class="min-w-full bg-white">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="py-3 px-4 text-left">Peminjam</th>
                <th class="py-3 px-4 text-left">Buku</th>
                <th class="py-3 px-4 text-left">Tgl Pinjam</th>
                <th class="py-3 px-4 text-left">Tgl Kembali</th>
                <th class="py-3 px-4 text-left">Status</th>
                <th class="py-3 px-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @foreach($transactions as $trx)
            <tr class="border-b hover:bg-gray-50">
                <td class="py-3 px-4">{{ $trx->user->nama_lengkap }}</td>
                <td class="py-3 px-4">{{ $trx->book->judul }}</td>
                <td class="py-3 px-4">{{ $trx->tanggal_pinjam }}</td>
                <td class="py-3 px-4">{{ $trx->tanggal_kembali ?? '-' }}</td>
                <td class="py-3 px-4">
                    <span class="px-2 py-1 rounded text-sm {{ $trx->status == 'pinjam' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800' }}">
                        {{ ucfirst($trx->status) }}
                    </span>
                </td>
                <td class="py-3 px-4 text-center">
                    @if($trx->status == 'pinjam')
                        <form action="{{ route('transactions.complete', $trx->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                                Kembalikan
                            </button>
                        </form>
                    @else
                        <span class="text-gray-400 text-sm">Selesai</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
