@extends('layouts.admin')

@section('content')
<h2 class="text-2xl font-bold text-gray-800 mb-6">📋 Transaksi Peminjaman</h2>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-bold">
            <tr>
                <th class="px-6 py-4">Peminjam</th>
                <th class="px-6 py-4">Buku</th>
                <th class="px-6 py-4">Tanggal</th>
                <th class="px-6 py-4">Status</th>
                <th class="px-6 py-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($transactions as $t)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-bold">{{ $t->user->name }}</td>
                <td class="px-6 py-4">{{ $t->book->judul }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $t->borrowed_at }}</td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $t->status == 'borrowed' ? 'bg-yellow-100 text-yellow-600' : 'bg-green-100 text-green-600' }}">
                        {{ $t->status == 'borrowed' ? 'Dipinjam' : 'Kembali' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-center">
                    @if($t->status == 'borrowed')
                        <form action="{{ route('transactions.return', $t->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs shadow">
                                Terima Kembali
                            </button>
                        </form>
                    @else
                        <span class="text-gray-400 text-xs"><i class="fas fa-check-circle"></i> Selesai</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center py-6 text-gray-400">Belum ada transaksi.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
