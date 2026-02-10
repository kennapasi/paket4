@extends('layouts.admin')

@section('content')
<h2 class="text-2xl font-bold text-gray-800 mb-6">👥 Data Anggota</h2>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-bold">
            <tr>
                <th class="px-6 py-4">Nama</th>
                <th class="px-6 py-4">Email / Login ID</th>
                <th class="px-6 py-4">Bergabung</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($users as $user)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-bold text-gray-800">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-xs font-bold">
                            {{ substr($user->name, 0, 2) }}
                        </div>
                        {{ $user->name }}
                    </div>
                </td>
                <td class="px-6 py-4 text-gray-600">{{ $user->email ?? $user->login_id }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
            </tr>
            @empty
            <tr><td colspan="3" class="text-center py-6 text-gray-400">Belum ada anggota.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
