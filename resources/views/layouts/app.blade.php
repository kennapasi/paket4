
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <nav class="bg-blue-600 p-4 shadow-lg text-white">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/dashboard" class="font-bold text-xl">Perpus Sekolah</a>
            <div>
                {{-- @if(Auth::user()->role == 'admin') --}}
                    {{-- <a href="{{ route('books.index') }}" class="px-4 hover:underline">Data Buku</a> --}}
                    {{-- <a href="{{ route('transactions.index') }}" class="px-4 hover:underline">Transaksi</a> --}}
                {{-- @endif --}}
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 px-3 py-1 rounded hover:bg-red-700">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-8 px-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>

</body>
</html>
