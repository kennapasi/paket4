<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen">

    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="bg-blue-600 p-2 rounded-lg shadow-blue-200 shadow-lg text-white">
                    <i class="fas fa-book-open text-xl"></i>
                </div>
                <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('books.index') }}" class="font-bold text-xl tracking-tight text-slate-800">
                    Perpus<span class="text-blue-600">Ku</span>
                </a>
            </div>

            <div class="flex items-center space-x-2 md:space-x-6">
                <a href="{{ route('books.index') }}" class="hidden md:block text-slate-600 hover:text-blue-600 font-medium transition-colors">
                    Katalog Buku
                </a>

                @if(Auth::user()->role === 'peminjam')
                    <a href="{{ route('transactions.index') }}" class="hidden md:block text-slate-600 hover:text-blue-600 font-medium transition-colors">
                        Pinjaman Saya
                    </a>
                @endif

                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="hidden md:block text-slate-600 hover:text-blue-600 font-medium transition-colors">
                        Dashboard
                    </a>
                @endif

                <div class="flex items-center gap-4 pl-4 border-l border-slate-200">
                    <div class="hidden sm:block text-right">
                        <p class="text-xs font-semibold text-slate-800 leading-none">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-slate-500 uppercase tracking-wider font-bold mt-1">{{ Auth::user()->role }}</p>
                    </div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-rose-50 text-rose-600 p-2 rounded-lg hover:bg-rose-600 hover:text-white transition-all shadow-sm border border-rose-100 flex items-center gap-2 text-sm font-semibold">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="hidden md:inline">Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto mt-10 px-4 pb-20">
        @if(session('success'))
            <div id="alert" class="flex items-center p-4 mb-6 text-emerald-800 rounded-2xl bg-emerald-50 border border-emerald-100 shadow-sm animate-fade-in-down">
                <i class="fas fa-check-circle mr-3"></i>
                <div class="text-sm font-medium">{{ session('success') }}</div>
                <button onclick="document.getElementById('alert').remove()" class="ml-auto text-emerald-500 hover:text-emerald-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div id="alert-error" class="flex items-center p-4 mb-6 text-rose-800 rounded-2xl bg-rose-50 border border-rose-100 shadow-sm animate-fade-in-down">
                <i class="fas fa-exclamation-triangle mr-3"></i>
                <div class="text-sm font-medium">{{ session('error') }}</div>
                <button onclick="document.getElementById('alert-error').remove()" class="ml-auto text-rose-500 hover:text-rose-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="border-t border-slate-200 bg-white py-8 mt-auto">
        <div class="container mx-auto px-4 text-center text-slate-500 text-sm">
            &copy; 2024 Perpustakaan Digital Sekolah. Built with ❤️ for Students.
        </div>
    </footer>

</body>
</html>
