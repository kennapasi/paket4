<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'stok',
    ];

    // Relasi: Satu buku bisa ada di banyak transaksi
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
