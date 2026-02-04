@extends('layouts.app')

@section('content')
<style>
    /* CSS Kustom untuk tampilan modern */
    .book-card {
        border: none;
        border-radius: 15px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .book-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.15);
    }
    .status-badge {
        border-radius: 20px;
        padding: 5px 15px;
        font-size: 0.8rem;
    }
    .page-title {
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 30px;
    }
    .btn-modern {
        border-radius: 10px;
        padding: 8px 20px;
        font-weight: 600;
        transition: 0.3s;
    }
</style>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title">📚 Katalog Perpustakaan</h2>

        @if(Auth::user()->role === 'admin')
            <a href="{{ route('books.create') }}" class="btn btn-primary btn-modern">
                <i class="fas fa-plus me-2"></i> Tambah Buku Baru
            </a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 12px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">
        @foreach($books as $book)
        <div class="col-md-4 col-lg-3">
            <div class="card h-100 book-card">
                <div class="card-body p-4">
                    <div class="mb-3">
                        <span class="badge {{ $book->stok > 0 ? 'bg-light text-success' : 'bg-light text-danger' }} status-badge">
                            {{ $book->stok > 0 ? 'Tersedia: '.$book->stok : 'Stok Habis' }}
                        </span>
                    </div>

                    <h5 class="card-title fw-bold text-dark mb-1">{{ $book->judul }}</h5>
                    <p class="text-muted small mb-3">Oleh: {{ $book->penulis }}</p>

                    <hr class="my-3 opacity-50">

                    <div class="d-grid">
                        @if(Auth::user()->role === 'admin')
                            <div class="d-flex gap-2">
                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-outline-warning btn-modern flex-fill">Edit</a>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="flex-fill">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-outline-danger btn-modern w-100" onclick="return confirm('Hapus buku ini?')">Hapus</button>
                                </form>
                            </div>
                        @else
                            <form action="{{ route('transactions.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <button type="submit" class="btn btn-success btn-modern w-100" {{ $book->stok <= 0 ? 'disabled' : '' }}>
                                    <i class="fas fa-bookmark me-2"></i> {{ $book->stok <= 0 ? 'Tidak Tersedia' : 'Pinjam Sekarang' }}
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
