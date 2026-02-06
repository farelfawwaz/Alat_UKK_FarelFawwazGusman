@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="space-y-8 px-4 sm:px-6 lg:px-8 py-8">

        <!-- Header dengan Background Gradient -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl shadow-lg p-8 text-white">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-4xl font-bold tracking-tight">
                        Dashboard Peminjaman Alat
                    </h1>
                    <p class="text-blue-100 mt-2">Kelola dan pantau semua peminjaman alat dengan mudah</p>
                </div>
            </div>
        </div>

        <!-- Statistik Cards dengan Design Modern -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Alat -->
            <div
                class="group relative bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-blue-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div class="relative p-6 flex items-start justify-between">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Alat</p>
                        <p class="text-4xl font-bold text-blue-600 mt-2">{{ $totalAlat }}</p>
                        <p class="text-xs text-gray-400 mt-3">Seluruh inventaris alat</p>
                    </div>
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                        </svg>

                    </div>
                </div>
            </div>

            <!-- Alat Dipinjam -->
            <div
                class="group relative bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-yellow-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div class="relative p-6 flex items-start justify-between">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Alat Dipinjam</p>
                        <p class="text-4xl font-bold text-yellow-500 mt-2">{{ $alatDipinjam }}</p>
                        <p class="text-xs text-gray-400 mt-3">Sedang digunakan peminjam</p>
                    </div>
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-yellow-400 to-yellow-500 text-white rounded-xl flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h10M7 7l4-4m-4 4l4 4M17 17H7m10 0l-4-4m4 4l-4 4" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Alat Tersedia -->
            <div
                class="group relative bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-green-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div class="relative p-6 flex items-start justify-between">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Alat Tersedia</p>
                        <p class="text-4xl font-bold text-green-600 mt-2">{{ $totalStokTersedia }}</p>
                        <p class="text-xs text-gray-400 mt-3">Siap untuk dipinjam</p>
                    </div>
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 text-white rounded-xl flex items-center justify-center font-bold text-xl shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                        ✓
                    </div>
                </div>
            </div>

            <!-- Pengajuan Baru -->
            <div
                class="group relative bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-indigo-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div class="relative p-6 flex items-start justify-between">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Pengajuan Baru</p>
                        <p class="text-4xl font-bold text-indigo-600 mt-2">{{ $pengajuanBaru }}</p>
                        <p class="text-xs text-gray-400 mt-3">Menunggu persetujuan</p>
                    </div>
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,20a9,9,0,1,1,9-9A9,9,0,0,1,12,21Z" />
                            <rect width="2" height="7" x="11" y="6" fill="currentColor" rx="1">
                                <animateTransform attributeName="transform" dur="9s" repeatCount="indefinite"
                                    type="rotate" values="0 12 12;360 12 12" />
                            </rect>
                            <rect width="2" height="9" x="11" y="11" fill="currentColor" rx="1">
                                <animateTransform attributeName="transform" dur="0.75s" repeatCount="indefinite"
                                    type="rotate" values="0 12 12;360 12 12" />
                            </rect>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Peminjaman dengan Design Premium -->
        @auth
            @if (in_array(auth()->user()->role, ['admin', 'petugas']))
                <!-- Tabel Peminjaman dengan Design Premium -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <!-- Header Tabel -->
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200 p-6">
                        <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                            <span class="w-1 h-6 bg-blue-600 rounded-full"></span>
                            Peminjaman Terbaru
                        </h2>
                        <p class="text-sm text-gray-500 mt-1">Daftar peminjaman alat terkini</p>
                    </div>

                    <table class="w-full text-sm">
                        <thead class="bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                            <tr>
                                <th class="px-6 py-3 text-left">Peminjam</th>
                                <th class="px-6 py-3 text-left">Alat</th>
                                <th class="px-6 py-3 text-center">Jumlah</th>
                                <th class="px-6 py-3 text-center">Status</th>
                                <th class="px-6 py-3 text-center">Tanggal Pinjam</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            @forelse ($peminjamanTerbaru as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        {{ $item->nama_peminjam?? '-' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $item->alat->nama_alat ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        {{ $item->jumlah }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold
                        @if ($item->status == 'menunggu') bg-yellow-100 text-yellow-700
                        @elseif ($item->status == 'dipinjam')
                            bg-blue-100 text-blue-700
                        @else
                            bg-green-100 text-green-700 @endif">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-6 text-center text-gray-400">
                                        Belum ada data peminjaman
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif
        @endauth


        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Login Berhasil',
                    text: '{{ session('success') }}',
                    timer: 2000,
                    showConfirmButton: false
                });
            </script>
        @endif

    @endsection
