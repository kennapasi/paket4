<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Perpustakaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .video-bg {
            position: fixed; right: 0; bottom: 0;
            min-width: 100%; min-height: 100%;
            z-index: -1; object-fit: cover;
            filter: brightness(40%);
        }
    </style>
</head>
<body class="flex items-center justify-center h-screen text-white">

    <video autoplay muted loop class="video-bg">
        <source src="https://videos.pexels.com/video-files/2928896/2928896-hd_1920_1080_24fps.mp4" type="video/mp4">
    </video>

    <div class="bg-black/40 backdrop-blur-md p-8 rounded-2xl shadow-2xl w-full max-w-md border border-white/10">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold mb-2">Selamat Datang</h2>
            <p class="text-gray-300 text-sm">Silakan masuk dengan akun Anda</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-6">
                <label for="login_id" class="block text-sm font-medium text-gray-300 mb-2">Username / Email</label>
                <input id="login_id" type="text" name="login_id" required autofocus
                    class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                    placeholder="Masukkan username atau email">
                @error('login_id')
                    <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                <input id="password" type="password" name="password" required
                    class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                    placeholder="••••••••">
                @error('password')
                    <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                class="w-full py-3 px-4 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-bold rounded-lg shadow-lg transform transition hover:scale-105">
                MASUK
            </button>
        </form>
    </div>

</body>
</html>
