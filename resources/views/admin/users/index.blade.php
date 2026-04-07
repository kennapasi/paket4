@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-6 border-b border-slate-50">
        <h3 class="font-bold text-slate-800 text-xl">Data Anggota Terdaftar</h3>
        <p class="text-slate-500 text-sm mt-1">Daftar semua siswa yang memiliki akses untuk meminjam buku di perpustakaan.</p>
    </div>

    <div class="p-6 overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-slate-400 text-sm uppercase tracking-wider border-b border-slate-100">
                    <th class="pb-4 px-4 font-semibold">Profil Anggota</th>
                    <th class="pb-4 px-4 font-semibold">Alamat Email</th>
                    <th class="pb-4 px-4 font-semibold">Tgl Bergabung</th>
                    <th class="pb-4 px-4 font-semibold text-center">Status Akses</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($users as $user)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="py-4 px-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-500 to-indigo-500 flex items-center justify-center text-white font-bold text-sm shadow-sm">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                            <span class="font-bold text-slate-700">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td class="py-4 px-4 text-slate-600">
                        <i class="fas fa-envelope text-slate-300 mr-2"></i> {{ $user->email }}
                    </td>
                    <td class="py-4 px-4 text-slate-500">
                        {{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}
                    </td>
                    <td class="py-4 px-4 text-center">
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-600 border border-emerald-100">
                            <i class="fas fa-check-circle mr-1"></i> Aktif
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-12 text-center text-slate-400">
                        <i class="fas fa-users-slash text-4xl mb-3"></i>
                        <p>Belum ada anggota (siswa) yang terdaftar di sistem.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
