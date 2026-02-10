<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Perpustakaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .nav-item.active {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.1) 0%, rgba(59, 130, 246, 0) 100%);
            border-left: 4px solid #3b82f6;
            color: #60a5fa;
        }
        .nav-item:hover:not(.active) {
            background-color: rgba(255, 255, 255, 0.05);
            color: #fff;
        }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-72 bg-slate-900 text-slate-300 flex flex-col fixed h-full shadow-2xl z-50 transition-all duration-300">
            <div class="p-8 flex items-center gap-3 border-b border-slate-800/50">
                <div class="bg-blue-600 p-2.5 rounded-xl shadow-lg shadow-blue-500/30 text-white">
                    <i class="fas fa-book-open text-lg"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-white tracking-tight">Perpus<span class="text-blue-500">Ku</span></h1>
                    <p class="text-[10px] uppercase tracking-wider text-slate-500 font-semibold mt-0.5">Administrator</p>
                </div>
            </div>

           <nav class="flex-1 px-4 py-6 space-y-2">
    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-800' }} rounded-lg transition">
        <i class="fas fa-home w-6"></i> <span>Dashboard</span>
    </a>

    <p class="text-xs text-gray-500 uppercase mt-4 mb-2 px-4">Master Data</p>

    <a href="{{ route('admin.books.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.books.*') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-800' }} rounded-lg transition">
        <i class="fas fa-book w-6"></i> <span>Kelola Buku</span>
    </a>

    <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.users.*') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-800' }} rounded-lg transition">
        <i class="fas fa-users w-6"></i> <span>Data Anggota</span>
    </a>

    <p class="text-xs text-gray-500 uppercase mt-4 mb-2 px-4">Transaksi</p>

    <a href="{{ route('admin.transactions.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.transactions.*') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-800' }} rounded-lg transition">
        <i class="fas fa-clipboard-list w-6"></i> <span>Peminjaman</span>
    </a>
</nav>

            <div class="p-4 border-t border-slate-800/50 bg-slate-900/50 backdrop-blur-sm">
                <div class="flex items-center gap-3 px-2 mb-4">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-500 to-purple-500 flex items-center justify-center text-white font-bold text-sm shadow-lg">
                        {{ substr(Auth::user()->name, 0, 2) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-500 truncate">Online</p>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-800 hover:bg-rose-600 text-slate-300 hover:text-white rounded-xl text-sm font-medium transition-all duration-200 group">
                        <i class="fas fa-sign-out-alt group-hover:-translate-x-1 transition-transform"></i> Keluar
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 ml-72 p-8 h-full overflow-y-auto bg-slate-50 scroll-smooth">
            <div class="max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>

    </div>

</body>
</html>
