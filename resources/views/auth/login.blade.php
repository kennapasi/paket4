<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - PerpusKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full" x-data="{ role: 'user' }">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-600 text-white shadow-lg mb-4">
                <i class="fas fa-book-reader text-3xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-slate-800 tracking-tight">Perpus<span class="text-blue-600">Ku</span></h1>
            <p class="text-slate-500 mt-2">Masuk untuk melanjutkan eksplorasi</p>
        </div>

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

            <div class="flex border-b border-slate-100">
                <button @click="role = 'user'" :class="role === 'user' ? 'text-blue-600 border-b-2 border-blue-600 font-bold bg-blue-50/50' : 'text-slate-400 hover:text-slate-600 font-medium'" class="flex-1 py-4 text-sm transition-all outline-none">
                    <i class="fas fa-user mr-2"></i> Anggota (User)
                </button>
                <button @click="role = 'admin'" :class="role === 'admin' ? 'text-blue-600 border-b-2 border-blue-600 font-bold bg-blue-50/50' : 'text-slate-400 hover:text-slate-600 font-medium'" class="flex-1 py-4 text-sm transition-all outline-none">
                    <i class="fas fa-user-shield mr-2"></i> Administrator
                </button>
            </div>

            <div class="p-8">
                @if($errors->any())
                <div class="bg-red-50 text-red-500 p-3 rounded-xl text-sm mb-6 flex items-start gap-3">
                    <i class="fas fa-exclamation-circle mt-0.5"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Email / Username</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-slate-400"></i>
                            </div>
                            <input type="text" name="login_id" value="{{ old('login_id') }}" required class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition-all" placeholder="Masukkan email atau username">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-slate-400"></i>
                            </div>
                            <input type="password" name="password" required class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition-all" placeholder="••••••••">
                        </div>
                    </div>

                    <button type="submit" :class="role === 'user' ? 'bg-blue-600 hover:bg-blue-700' : 'bg-slate-800 hover:bg-slate-900'" class="w-full text-white font-bold py-3 rounded-xl transition-colors shadow-lg">
                        <span x-show="role === 'user'">Masuk sebagai Anggota</span>
                        <span x-show="role === 'admin'">Masuk sebagai Admin</span>
                    </button>
                </form>

                <div x-show="role === 'user'" x-transition class="mt-6 text-center border-t border-slate-100 pt-6">
                    <p class="text-sm text-slate-500 mb-2">Belum punya akun?</p>
                    <a href="{{ route('register') }}" class="inline-block w-full py-3 bg-white border-2 border-slate-200 text-slate-700 font-bold rounded-xl hover:border-blue-600 hover:text-blue-600 transition-all">
                        Daftar Akun Baru
                    </a>
                </div>

                <div x-show="role === 'admin'" x-transition class="mt-6 text-center border-t border-slate-100 pt-6">
                    <p class="text-xs text-slate-400">
                        <i class="fas fa-info-circle mr-1"></i> Akun administrator hanya dapat dibuat oleh Developer.
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
