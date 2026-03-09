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

        // Perbaikan: Ubah 'username' menjadi 'name' sesuai struktur DB Laravel
        $loginType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        $credentials = [$loginType => $request->login_id, 'password' => $request->password];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect sesuai jabatan
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('user.dashboard');
        }

        return back()->withErrors(['login_id' => 'Email/Nama atau Password salah.'])->withInput();
    }

    // --- FITUR REGISTER ---
    public function showRegisterForm() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password wajib di-hash
            'role' => 'peminjam',
        ]);

        Auth::login($user);
        return redirect()->route('user.dashboard')->with('success', 'Akun berhasil dibuat!');
    }

    // --- LOGOUT ---
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
