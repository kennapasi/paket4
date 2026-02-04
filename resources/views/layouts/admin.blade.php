<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Perpustakaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-gray-900 text-white flex flex-col fixed h-full transition-all duration-300">
            <div class="p-6 text-center border-b border-gray-800">
                <h1 class="text-2xl font-bold text-blue-500">PERPUSTAKAAN</h1>
                <p class="text-xs text-gray-400 mt-1">Administrator Area</p>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 bg-gray-800 text-white rounded-lg transition hover:bg-blue-600">
                    <i class="fas fa-home w-6"></i> <span>Dashboard</span>
                </a>

                <p class="text-xs text-gray-500 uppercase mt-4 mb-2 px-4">Master Data</p>

                <a href="#" class="flex items-center px-4 py-3 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition">
                    <i class="fas fa-book w-6"></i> <span>Kelola Buku</span>
                </a>

                <a href="#" class="flex items-center px-4 py-3 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition">
                    <i class="fas fa-users w-6"></i> <span>Data Anggota</span>
                </a>

                <p class="text-xs text-gray-500 uppercase mt-4 mb-2 px-4">Transaksi</p>

                <a href="#" class="flex items-center px-4 py-3 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition">
                    <i class="fas fa-clipboard-list w-6"></i> <span>Peminjaman</span>
                </a>
            </nav>

            <div class="p-4 border-t border-gray-800">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg text-sm transition">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 ml-64 p-8 overflow-y-auto h-full">
            @yield('content')
        </main>

    </div>

</body>
</html>
