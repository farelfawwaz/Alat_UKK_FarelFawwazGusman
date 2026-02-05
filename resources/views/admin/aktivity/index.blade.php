@extends('layouts.app')

@section('title', 'Log Aktivitas')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900">Log Aktivitas</h1>
    <p class="text-gray-500 mt-2">Riwayat aktivitas pengguna</p>
</div>

<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-blue-600 text-white">
            <tr>
                <th class="px-6 py-4 text-left">User</th>
                <th class="px-6 py-4 text-left">Aksi</th>
                <th class="px-6 py-4 text-left">Modul</th>
                <th class="px-6 py-4 text-left">Deskripsi</th>
                <th class="px-6 py-4 text-center">Waktu</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @foreach ($logs as $log)
            <tr>
                <td class="px-6 py-4">
                    {{ $log->user->name ?? 'System' }}
                </td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 rounded-full text-xs
                        @if($log->aksi === 'hapus') bg-red-100 text-red-600
                        @elseif($log->aksi === 'tambah') bg-green-100 text-green-600
                        @else bg-blue-100 text-blue-600 @endif">
                        {{ strtoupper($log->aksi) }}
                    </span>
                </td>
                <td class="px-6 py-4">{{ ucfirst($log->modul) }}</td>
                <td class="px-6 py-4">{{ $log->deskripsi }}</td>
                <td class="px-6 py-4 text-center">
                    {{ $log->created_at->format('d M Y H:i') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $logs->links() }}
</div>
@endsection
