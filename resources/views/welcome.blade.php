<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpustakaan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* CSS untuk Video Background */
        .video-bg {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
            z-index: -1;
            object-fit: cover;
            filter: brightness(50%); /* Gelapkan video supaya teks terbaca */
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .bg-gambar {
            background-image: url('/melet.png');
            background-position: center;

        }
    </style>
</head>
<body class="antialiased text-white h-screen bg-gambar flex flex-col justify-center items-center">

    <video autoplay muted loop class="video-bg">
        <source src="https://videos.pexels.com/video-files/2928896/2928896-hd_1920_1080_24fps.mp4" type="video/mp4">
        Your browser does not support HTML5 video.
    </video>

    <div class="z-10 text-center px-4">
        <h1 class="text-5xl font-bold mb-4 tracking-tight">Perpustakaan Digital</h1>
        <p class="text-xl mb-12 text-gray-200">Jelajahi dunia pengetahuan dalam genggamanmu.</p>

        <div class="flex flex-col md:flex-row gap-6 justify-center">

            <a href="{{ route('login') }}" class="glass-card p-8 rounded-2xl hover:bg-white/20 transition transform hover:-translate-y-2 cursor-pointer w-64 group">
                <div class="bg-blue-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition">
                   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users-round-icon lucide-users-round"><path d="M18 21a8 8 0 0 0-16 0"/><circle cx="10" cy="8" r="5"/><path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3"/></svg>
                </div>
                <h3 class="text-xl font-bold">Siswa / Admin</h3>
                <p class="text-sm text-gray-300 mt-2">Try for ur experience</p>
            </a>

            {{-- <a href="{{ route('login') }}" class="glass-card p-8 rounded-2xl hover:bg-white/20 transition transform hover:-translate-y-2 cursor-pointer w-64 group">
                <div class="bg-purple-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold">Administrator</h3>
                <p class="text-sm text-gray-300 mt-2">Kelola buku & peminjaman</p>
            </a> --}}

        </div>
    </div>

    <div class="fixed bottom-4 text-xs text-gray-400">
        &copy; 2026 Perpustakaan Digital Sekolah
    </div>
</body>
</html>
