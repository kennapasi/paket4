<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // --- FITUR LOGIN ---
    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'login_id' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cek apakah user memasukkan email atau username
        $loginType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [$loginType => $request->login_id, 'password' => $request->password];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Pintu Tol: Pisahkan Admin dan User
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('user.dashboard');
        }

        return back()->withErrors(['login_id' => 'Email/Username atau Password salah.'])->withInput();
    }

    // --- FITUR REGISTER (Khusus User) ---
    public function showRegisterForm() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // Butuh konfirmasi password
        ], [
            'email.unique' => 'Email ini sudah terdaftar, silakan gunakan email lain.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.'
        ]);

        // Buat akun baru dengan role otomatis 'peminjam' (user biasa)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'peminjam', // Default role untuk user yang mendaftar
        ]);

        // Langsung login otomatis setelah daftar
        Auth::login($user);

        // Arahkan ke dashboard user
        return redirect()->route('user.dashboard')->with('success', 'Selamat datang! Akun Anda berhasil dibuat.');
    }

    // --- FITUR LOGOUT ---
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
