<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - PerpusKu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Quicksand', sans-serif;
            background: linear-gradient(145deg, #f0e6ff 0%, #d9c9ff 30%, #c2b0ff 60%, #e6d9ff 100%);
            background-size: 400% 400%;
            animation: waterFlow 15s ease infinite;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 1rem;
            position: relative;
            overflow-x: hidden;
        }

        @keyframes waterFlow {
            0% { background-position: 0% 0%; }
            25% { background-position: 50% 25%; }
            50% { background-position: 100% 50%; }
            75% { background-position: 50% 75%; }
            100% { background-position: 0% 100%; }
        }

        /* Water Ripple Effect */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(circle at 30% 50%, rgba(255, 255, 255, 0.3) 0%, transparent 30%),
                radial-gradient(circle at 70% 80%, rgba(200, 180, 255, 0.4) 0%, transparent 40%),
                radial-gradient(circle at 10% 20%, rgba(230, 210, 255, 0.5) 0%, transparent 50%),
                radial-gradient(circle at 90% 40%, rgba(180, 150, 255, 0.3) 0%, transparent 45%);
            animation: rippleMove 20s infinite alternate;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes rippleMove {
            0% { transform: scale(1) rotate(0deg); opacity: 0.4; }
            50% { transform: scale(1.2) rotate(5deg); opacity: 0.6; }
            100% { transform: scale(0.9) rotate(-5deg); opacity: 0.5; }
        }

        /* Floating Bubbles */
        .bubble {
            position: fixed;
            background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.8), rgba(230, 210, 255, 0.3));
            border-radius: 50%;
            filter: blur(5px);
            animation: bubbleFloat 15s infinite ease-in-out;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes bubbleFloat {
            0%, 100% {
                transform: translateY(0) translateX(0) scale(1);
                opacity: 0.3;
            }
            25% {
                transform: translateY(-30px) translateX(15px) scale(1.1);
                opacity: 0.5;
            }
            50% {
                transform: translateY(0) translateX(30px) scale(0.9);
                opacity: 0.4;
            }
            75% {
                transform: translateY(30px) translateX(-15px) scale(1.2);
                opacity: 0.6;
            }
        }

        .bubble-1 { width: 300px; height: 300px; top: 10%; left: 5%; animation-delay: 0s; }
        .bubble-2 { width: 400px; height: 400px; bottom: 10%; right: 5%; animation-delay: -3s; }
        .bubble-3 { width: 200px; height: 200px; top: 40%; right: 20%; animation-delay: -6s; }
        .bubble-4 { width: 350px; height: 350px; bottom: 30%; left: 15%; animation-delay: -9s; }
        .bubble-5 { width: 150px; height: 150px; top: 70%; right: 35%; animation-delay: -12s; }

        /* Wave Lines */
        body::after {
            content: '';
            position: fixed;
            inset: 0;
            background: repeating-linear-gradient(
                transparent 0px,
                transparent 20px,
                rgba(210, 190, 255, 0.1) 20px,
                rgba(210, 190, 255, 0.1) 22px
            );
            animation: waveMove 8s infinite linear;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes waveMove {
            from { background-position: 0 0; }
            to { background-position: 0 40px; }
        }

        /* Glass Card */
        .glass-card {
            background: rgba(255, 255, 255, 0.35);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 20px 50px rgba(150, 120, 255, 0.15), 0 0 0 1px rgba(255, 255, 255, 0.3) inset;
            border-radius: 32px;
            position: relative;
            z-index: 1;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(230, 210, 255, 0.3);
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(170, 140, 250, 0.5);
            border-radius: 20px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(150, 120, 240, 0.7);
        }

        /* Selection */
        ::selection {
            background: rgba(200, 180, 255, 0.5);
            color: #4a3b6e;
        }

        /* Input Focus Effect */
        input:focus {
            transform: translateY(-1px);
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'quicksand': ['Quicksand', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="font-quicksand">

    <!-- Floating Bubbles -->
    <div class="bubble bubble-1"></div>
    <div class="bubble bubble-2"></div>
    <div class="bubble bubble-3"></div>
    <div class="bubble bubble-4"></div>
    <div class="bubble bubble-5"></div>

    <div class="max-w-lg w-full relative z-10 transform transition-all duration-500 hover:scale-[1.02]">
        <div class="glass-card rounded-3xl overflow-hidden">
            <div class="p-8">
                <!-- Header dengan efek glass -->
                <div class="text-center mb-8">
                    <div class="bg-gradient-to-tr from-[#8a2be2] to-[#b483ff] w-16 h-16 rounded-2xl flex items-center justify-center text-white text-2xl mx-auto mb-4 shadow-lg shadow-purple-500/30 transform transition-transform duration-300 hover:scale-110">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-[#4a3b6e] tracking-tight">Daftar Akun Baru </h2>
                    <p class="text-[#6b5b8e] mt-2 text-sm font-medium">Bergabunglah dan mulai jelajahi koleksi buku kami.</p>
                </div>

                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <!-- Nama Lengkap -->
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-[#4a3b6e] mb-2">
                            <i class="fas fa-user mr-2 text-[#7b68b0]"></i>Nama Lengkap
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-user text-[#b8a9d4]"></i>
                            </div>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-white/30 bg-white/20 backdrop-blur-sm focus:bg-white/40 focus:border-[#7b68b0] focus:ring-2 focus:ring-[#b483ff]/50 outline-none transition-all text-[#4a3b6e] placeholder-[#a89bc8]"
                                placeholder="Misal: Budi Santoso" required>
                        </div>
                        @error('name') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <!-- Username -->
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-[#4a3b6e] mb-2">
                            <i class="fas fa-at mr-2 text-[#7b68b0]"></i>Username
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-user-tag text-[#b8a9d4]"></i>
                            </div>
                            <input type="text" name="username" value="{{ old('username') }}"
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-white/30 bg-white/20 backdrop-blur-sm focus:bg-white/40 focus:border-[#7b68b0] focus:ring-2 focus:ring-[#b483ff]/50 outline-none transition-all text-[#4a3b6e] placeholder-[#a89bc8]"
                                placeholder="Misal: budi_santoso" required>
                        </div>
                        @error('username') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-[#4a3b6e] mb-2">
                            <i class="fas fa-envelope mr-2 text-[#7b68b0]"></i>Alamat Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-[#b8a9d4]"></i>
                            </div>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-white/30 bg-white/20 backdrop-blur-sm focus:bg-white/40 focus:border-[#7b68b0] focus:ring-2 focus:ring-[#b483ff]/50 outline-none transition-all text-[#4a3b6e] placeholder-[#a89bc8]"
                                placeholder="budi@example.com" required>
                        </div>
                        @error('email') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <!-- Password & Konfirmasi -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                        <div>
                            <label class="block text-sm font-bold text-[#4a3b6e] mb-2">
                                <i class="fas fa-lock mr-2 text-[#7b68b0]"></i>Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-key text-[#b8a9d4]"></i>
                                </div>
                                <input type="password" name="password"
                                    class="w-full pl-11 pr-4 py-3 rounded-xl border border-white/30 bg-white/20 backdrop-blur-sm focus:bg-white/40 focus:border-[#7b68b0] focus:ring-2 focus:ring-[#b483ff]/50 outline-none transition-all text-[#4a3b6e] placeholder-[#a89bc8]"
                                    placeholder="••••••••" required>
                            </div>
                            @error('password') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-[#4a3b6e] mb-2">
                                <i class="fas fa-check-circle mr-2 text-[#7b68b0]"></i>Konfirmasi Sandi
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-check-circle text-[#b8a9d4]"></i>
                                </div>
                                <input type="password" name="password_confirmation"
                                    class="w-full pl-11 pr-4 py-3 rounded-xl border border-white/30 bg-white/20 backdrop-blur-sm focus:bg-white/40 focus:border-[#7b68b0] focus:ring-2 focus:ring-[#b483ff]/50 outline-none transition-all text-[#4a3b6e] placeholder-[#a89bc8]"
                                    placeholder="••••••••" required>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-[#8a2be2] to-[#b483ff] hover:from-[#9b59b6] hover:to-[#c39bd3] text-white font-bold py-3 px-4 rounded-xl transition-all duration-300 shadow-lg shadow-purple-500/30 transform hover:scale-[1.02] hover:shadow-xl">
                        <i class="fas fa-user-plus mr-2"></i>
                        Buat Akun Sekarang
                    </button>
                </form>

                <!-- Login Link -->
                <div class="mt-8 text-center text-sm border-t border-white/30 pt-6">
                    <p class="text-[#6b5b8e]">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-[#8a2be2] font-bold hover:text-[#9b59b6] transition-colors hover:underline ml-1">
                            Masuk di sini →
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Decorative Footer -->
        <p class="text-center mt-6 text-xs text-[#6b5b8e]/70 font-medium">
            <i class="fas fa-water mr-1"></i> Bergabung dengan ribuan pembaca lainnya
        </p>
    </div>

</body>
</html>
