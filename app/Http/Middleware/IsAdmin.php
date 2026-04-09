<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Pengecekan Pertama: Apakah dia belum login sama sekali?
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Akses ditolak! Silakan login terlebih dahulu.');
        }

        // 2. Pengecekan Kedua: Dia sudah login, tapi apakah rolenya BUKAN admin?
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('user.dashboard')->with('error', 'Akses ditolak! Anda bukan Administrator.');
        }

        // 3. Jika lolos kedua ujian di atas (Berarti dia benar-benar Admin), persilakan masuk
        return $next($request);
    }
}
