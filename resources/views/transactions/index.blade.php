@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">📖 Pinjaman Saya</h2>

    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(Auth::user()->transactions as $transaction)
                    <tr>
                        <td class="ps-4">{{ $transaction->book->judul }}</td>
                        <td>{{ $transaction->borrowed_at }}</td>
                        <td>
                            <span class="badge bg-info text-dark">Dipinjam</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-4 text-muted">Anda belum meminjam buku apapun.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
