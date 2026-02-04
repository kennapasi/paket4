<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses Login
    public function login(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'login_id' => 'required|string', // Bisa email atau username
            'password' => 'required|string',
        ]);

        // 2. Tentukan apakah inputnya Email atau Username
        $loginType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // 3. Coba Login
        // Kita gabungkan info di atas menjadi array kredensial
        $credentials = [
            $loginType => $request->login_id,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // 4. Redirect sesuai Role
            // Kalau admin -> ke dashboard admin
            // Kalau siswa -> ke halaman buku
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/dashboard'); // Nanti kita buat rute ini
            }

            return redirect()->intended('/books');
        }

        // 5. Kalau Gagal
        return back()->withErrors([
            'login_id' => 'Username atau Password salah.',
        ]);
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
