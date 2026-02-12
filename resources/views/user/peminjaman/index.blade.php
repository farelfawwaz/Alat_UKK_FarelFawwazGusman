@extends('layouts.app')

@section('title', 'Peminjaman Saya')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header Section -->
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

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                        <th class="px-6 py-4 text-left font-semibold">Alat</th>
                        <th class="px-6 py-4 text-center font-semibold">Tanggal Pinjam</th>
                        <th class="px-6 py-4 text-center font-semibold">Status</th>
                        <th class="px-6 py-4 text-center font-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse ($peminjamans as $item)
                        <tr class="hover:bg-blue-50 transition">
                            <!-- Alat -->
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                        @if ($item->alat->image)
                                            <img src="{{ asset('storage/' . $item->alat->image) }}"
                                                alt="{{ $item->alat->nama_alat }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                                </svg>
                                            </div>
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
                            <td class="px-6 py-4 text-center font-medium text-gray-900">
                                {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4 text-center">
                                @if ($item->status === 'menunggu')
                                    <span class="px-3 py-1 text-xs font-semibold bg-yellow-100 text-yellow-700 rounded-full inline-block">
                                        Menunggu
                                    </span>
                                @elseif ($item->status === 'disetujui')
                                    <span class="px-3 py-1 text-xs font-semibold bg-blue-100 text-blue-700 rounded-full inline-block">
                                        Disetujui
                                    </span>
                                @elseif ($item->status === 'dikembalikan')
                                    <span class="px-3 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full inline-block">
                                        Dikembalikan
                                    </span>
                                @elseif ($item->status === 'ditolak')
                                    <span class="px-3 py-1 text-xs font-semibold bg-red-100 text-red-700 rounded-full inline-block">
                                        Ditolak
                                    </span>
                                @endif
                            </td>

                            <!-- Aksi -->
                            <td class="px-6 py-4 text-center">
                                @if ($item->status === 'ditolak')
                                    <button
                                        onclick="openRejectionModal('{{ $item->alat->nama_alat }}', `{{ $item->alasan_penolakan ?? 'Tidak ada alasan diberikan.' }}`)"
                                        class="inline-flex items-center gap-2 px-4 py-2 text-xs font-medium bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition border border-red-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Lihat Alasan
                                    </button>
                                @else
                                    <span class="text-gray-400 text-xs">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12">
                                <div class="text-center">
                                    <div class="text-5xl mb-4">📦</div>
                                    <p class="text-gray-500 font-medium text-lg">Belum ada data peminjaman</p>
                                    <p class="text-gray-400 text-sm">Silakan ajukan peminjaman alat</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $peminjamans->links() }}
    </div>
</div>

<!-- Sweet Alert Success -->
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: "{{ session('success') }}",
            confirmButtonColor: '#2563eb'
        });
    </script>
@endif

<!-- Sweet Alert Error -->
@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: "{{ session('error') }}",
            confirmButtonColor: '#dc2626'
        });
    </script>
@endif
@endsection
