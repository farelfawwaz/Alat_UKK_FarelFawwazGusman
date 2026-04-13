@extends('layouts.app')

@section('title', 'Log Aktivitas')

@section('content')
<div class="mb-6 sm:mb-8">
    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Log Aktivitas</h1>
    <p class="text-gray-500 mt-1 sm:mt-2 text-sm sm:text-base">Riwayat aktivitas pengguna</p>
</div>

<div class="bg-white rounded-xl shadow-lg overflow-hidden">

    <!-- Wrapper biar bisa scroll di HP -->
    <div class="overflow-x-auto">

        <table class="min-w-[700px] w-full text-xs sm:text-sm">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-3 sm:px-6 py-3 sm:py-4 text-left">User</th>
                    <th class="px-3 sm:px-6 py-3 sm:py-4 text-left">Aksi</th>
                    <th class="px-3 sm:px-6 py-3 sm:py-4 text-left">Modul</th>
                    <th class="px-3 sm:px-6 py-3 sm:py-4 text-left">Deskripsi</th>
                    <th class="px-3 sm:px-6 py-3 sm:py-4 text-center">Waktu</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @foreach ($logs as $log)
                <tr class="hover:bg-gray-50 transition">

                    <!-- USER -->
                    <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap">
                        {{ $log->user->name ?? 'System' }}
                    </td>

                    <!-- AKSI -->
                    <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap">
                        <span class="px-2 sm:px-3 py-1 rounded-full text-[10px] sm:text-xs
                            @if($log->aksi === 'hapus') bg-red-100 text-red-600
                            @elseif($log->aksi === 'tambah') bg-green-100 text-green-600
                            @else bg-blue-100 text-blue-600 @endif">
                            {{ strtoupper($log->aksi) }}
                        </span>
                    </td>

                    <!-- MODUL -->
                    <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap">
                        {{ ucfirst($log->modul) }}
                    </td>

                    <!-- DESKRIPSI -->
                    <td class="px-3 sm:px-6 py-3 sm:py-4">
                        <div class="max-w-[200px] sm:max-w-none truncate sm:whitespace-normal">
                            {{ $log->deskripsi }}
                        </div>
                    </td>

                    <!-- WAKTU -->
                    <td class="px-3 sm:px-6 py-3 sm:py-4 text-center whitespace-nowrap">
                        <span class="hidden sm:inline">
                            {{ $log->created_at->format('d M Y H:i') }}
                        </span>
                        <span class="sm:hidden">
                            {{ $log->created_at->format('d/m/y') }}
                        </span>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

<div class="mt-4 sm:mt-6">
    {{ $logs->links() }}
</div>
@endsection
