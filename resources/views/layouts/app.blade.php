<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-slate-50 text-slate-800">

    <nav class="bg-white shadow-sm border-b border-slate-100">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-6">
                    <a href="{{ route('user.dashboard') }}" class="text-xl font-bold text-blue-600 flex items-center gap-2">
                        <i class="fas fa-book-reader"></i> PerpusKu
                    </a>
                    <div class="hidden sm:flex space-x-4 ml-6">
                        <a href="{{ route('user.dashboard') }}" class="{{ request()->routeIs('user.dashboard') ? 'text-blue-600 font-semibold' : 'text-slate-500 hover:text-blue-600' }}">Dashboard</a>
                        <a href="{{ route('books.index') }}" class="{{ request()->routeIs('books.index') ? 'text-blue-600 font-semibold' : 'text-slate-500 hover:text-blue-600' }}">Katalog Buku</a>
                        <a href="{{ route('transactions.index') }}" class="{{ request()->routeIs('transactions.index') ? 'text-blue-600 font-semibold' : 'text-slate-500 hover:text-blue-600' }}">Peminjaman Saya</a>
                    </div>
                </div>

                <div class="flex items-center">
                    <span class="text-slate-600 mr-4 text-sm font-medium">Hai, {{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium">
                            <i class="fas fa-sign-out-alt"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-10 px-4 sm:px-6 lg:px-8">
        @yield('content')
    </main>

</body>
</html>
