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
        // Logika PENTING:
        // Jika User sudah login TAPI role-nya BUKAN 'admin',
        // tendang paksa dia ke halaman katalog buku user.
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('books.index');
        }

        return $next($request);
    }
}
