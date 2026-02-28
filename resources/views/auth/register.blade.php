<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - PerpusKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-slate-800 tracking-tight">Buat Akun</h1>
            <p class="text-slate-500 mt-2">Bergabunglah untuk mulai meminjam buku.</p>
        </div>

        <div class="bg-white rounded-3xl shadow-xl p-8">

            @if($errors->any())
            <div class="bg-red-50 text-red-500 p-3 rounded-xl text-sm mb-6 flex items-start gap-3">
                <i class="fas fa-exclamation-circle mt-0.5"></i>
                <ul class="list-disc pl-4">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600 outline-none" placeholder="John Doe">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600 outline-none" placeholder="john@example.com">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                    <input type="password" name="password" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600 outline-none" placeholder="Minimal 8 karakter">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600 outline-none" placeholder="Ulangi password di atas">
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition-colors shadow-lg mb-4">
                    Daftar Sekarang
                </button>
            </form>

            <div class="text-center mt-4">
                <p class="text-sm text-slate-500">Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>
