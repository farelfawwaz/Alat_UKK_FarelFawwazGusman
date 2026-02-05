@extends('layouts.app')

@section('title', 'Peminjaman Saya')

@section('content')

    <!-- Header -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    Peminjaman Saya
                </h1>
                <p class="text-gray-500 mt-2">
                    Daftar alat yang pernah dan sedang Anda pinjam
                </p>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                        <th class="px-6 py-4 text-left">Alat</th>
                        <th class="px-6 py-4 text-center">Tanggal Pinjam</th>
                        <th class="px-6 py-4 text-center">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse ($peminjamans as $item)
                        <tr class="hover:bg-blue-50 transition">
                            <!-- Alat -->
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 bg-gray-100 rounded-lg overflow-hidden">
                                        @if ($item->alat->image)
                                            <img src="{{ asset('storage/' . $item->alat->image) }}"
                                                class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">
                                            {{ $item->alat->nama_alat }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ $item->alat->kategori->name ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <!-- Tanggal -->
                            <td class="px-6 py-4 text-center font-medium">
                                {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4 text-center">
                                @if ($item->status === 'menunggu')
                                    <span
                                        class="px-4 py-1 text-xs font-semibold bg-yellow-100 text-yellow-700 rounded-full">
                                        Menunggu
                                    </span>
                                @elseif ($item->status === 'disetujui')
                                    <span
                                        class="px-4 py-1 text-xs font-semibold bg-blue-100 text-blue-700 rounded-full">
                                        Disetujui
                                    </span>
                                @elseif ($item->status === 'dikembalikan')
                                    <span
                                        class="px-4 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">
                                        Dikembalikan
                                    </span>
                                @elseif ($item->status === 'ditolak')
                                    <span
                                        class="px-4 py-1 text-xs font-semibold bg-red-100 text-red-700 rounded-full">
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center">
                                <div class="text-5xl mb-4">📦</div>
                                <p class="text-gray-500 font-medium text-lg">Belum ada data peminjaman</p>
                                <p class="text-gray-400 text-sm">Silakan ajukan peminjaman alat</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-8 flex justify-center">
        {{ $peminjamans->links() }}
    </div>

@endsection
