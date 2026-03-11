@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Dashboard Admin -->
    @if (auth()->check() && auth()->user()->role === 'admin')
        <div class="space-y-8 px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl shadow-lg p-8 text-white">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-4xl font-bold tracking-tight">Dashboard Admin</h1>
                        <p class="text-blue-100 mt-2">Kelola seluruh sistem peminjaman alat dengan mudah</p>
                    </div>
                    <div class="flex gap-2">
                        <span class="bg-blue-500 bg-opacity-50 px-4 py-2 rounded-lg text-sm font-medium">Pengguna: {{ auth()->user()->name }}</span>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Alat -->
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden border-l-4 border-blue-600">
                    <div class="p-6 flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Alat</p>
                            <p class="text-4xl font-bold text-blue-600 mt-2">{{ $totalAlat ?? 0 }}</p>
                            <p class="text-xs text-gray-400 mt-3">Seluruh inventaris</p>
                        </div>
                    </div>
                </div>

                <!-- Total Peminjam -->
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden border-l-4 border-purple-600">
                    <div class="p-6 flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Peminjam</p>
                            <p class="text-4xl font-bold text-purple-600 mt-2">{{ $totalPeminjam ?? 0 }}</p>
                            <p class="text-xs text-gray-400 mt-3">Pengguna terdaftar</p>
                        </div>
                    </div>
                </div>

                <!-- Alat Dipinjam -->
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden border-l-4 border-yellow-500">
                    <div class="p-6 flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Alat Dipinjam</p>
                            <p class="text-4xl font-bold text-yellow-500 mt-2">{{ $alatDipinjam ?? 0 }}</p>
                            <p class="text-xs text-gray-400 mt-3">Sedang digunakan</p>
                        </div>
                    </div>
                </div>

                <!-- Pengajuan Menunggu -->
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden border-l-4 border-red-500">
                    <div class="p-6 flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Menunggu Persetujuan</p>
                            <p class="text-4xl font-bold text-red-500 mt-2">{{ $pengajuanBaru ?? 0 }}</p>
                            <p class="text-xs text-gray-400 mt-3">Perlu ditinjau</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tables Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Peminjaman Terbaru -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200 p-6">
                        <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                            <span class="w-1 h-6 bg-blue-600 rounded-full"></span>
                            Peminjaman Terbaru
                        </h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                                <tr>
                                    <th class="px-4 py-3 text-left">Peminjam</th>
                                    <th class="px-4 py-3 text-left">Alat</th>
                                    <th class="px-4 py-3 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @forelse ($peminjamanTerbaru ?? [] as $item)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-4 py-3 font-medium text-gray-800">{{ $item->nama_peminjam ?? '-' }}</td>
                                        <td class="px-4 py-3 text-gray-600">{{ $item->alat->nama_alat ?? '-' }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                                @if ($item->status == 'menunggu') bg-yellow-100 text-yellow-700
                                                @elseif ($item->status == 'dipinjam') bg-blue-100 text-blue-700
                                                @else bg-green-100 text-green-700 @endif">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-4 py-6 text-center text-gray-400">
                                            Belum ada data
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Alat Kritis -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200 p-6">
                        <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                            <span class="w-1 h-6 bg-red-600 rounded-full"></span>
                            Alat Stok Terbatas
                        </h2>
                    </div>
                    <div class="p-6 space-y-4">
                        @forelse ($alatTerbatas ?? [] as $alat)
                            <div class="flex items-center justify-between p-4 bg-red-50 rounded-lg border border-red-200">
                                <div>
                                    <p class="font-medium text-gray-800">{{ $alat->nama_alat ?? '-' }}</p>
                                    <p class="text-sm text-gray-600">Stok: <span class="font-bold text-red-600">{{ $alat->stok ?? 0 }}</span></p>
                                </div>
                                <button class="px-3 py-1 bg-red-600 text-white rounded-lg text-sm hover:bg-red-700 transition-colors">
                                    Edit
                                </button>
                            </div>
                        @empty
                            <p class="text-center text-gray-400 py-6">Semua alat stok aman</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    <!-- Dashboard Petugas -->
    @elseif (auth()->check() && auth()->user()->role === 'petugas')
        <div class="space-y-8 px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="bg-gradient-to-r from-green-600 to-green-800 rounded-2xl shadow-lg p-8 text-white">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-4xl font-bold tracking-tight">Dashboard Petugas</h1>
                        <p class="text-green-100 mt-2">Kelola peminjaman dan pengembalian alat</p>
                    </div>
                    <div class="flex gap-2">
                        <span class="bg-green-500 bg-opacity-50 px-4 py-2 rounded-lg text-sm font-medium">Petugas: {{ auth()->user()->name }}</span>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Alat Tersedia -->
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden border-l-4 border-green-600">
                    <div class="p-6 flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Alat Tersedia</p>
                            <p class="text-4xl font-bold text-green-600 mt-2">{{ $totalStokTersedia ?? 0 }}</p>
                            <p class="text-xs text-gray-400 mt-3">Siap dipinjam</p>
                        </div>
                    </div>
                </div>

                <!-- Alat Dipinjam -->
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden border-l-4 border-blue-600">
                    <div class="p-6 flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Sedang Dipinjam</p>
                            <p class="text-4xl font-bold text-blue-600 mt-2">{{ $alatDipinjam ?? 0 }}</p>
                            <p class="text-xs text-gray-400 mt-3">Dalam pengembalian</p>
                        </div>
                    </div>
                </div>

                <!-- Pengajuan Baru -->
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden border-l-4 border-orange-600">
                    <div class="p-6 flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Pengajuan Baru</p>
                            <p class="text-4xl font-bold text-orange-600 mt-2">{{ $pengajuanBaru ?? 0 }}</p>
                            <p class="text-xs text-gray-400 mt-3">Perlu diproses</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Peminjaman -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200 p-6">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                        <span class="w-1 h-6 bg-green-600 rounded-full"></span>
                        Daftar Peminjaman
                    </h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gradient-to-r from-green-600 to-green-700 text-white">
                            <tr>
                                <th class="px-6 py-3 text-left">Peminjam</th>
                                <th class="px-6 py-3 text-left">Alat</th>
                                <th class="px-6 py-3 text-center">Jumlah</th>
                                <th class="px-6 py-3 text-center">Status</th>
                                <th class="px-6 py-3 text-center">Tanggal Pinjam</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @forelse ($peminjamanTerbaru ?? [] as $item)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 font-medium text-gray-800">{{ $item->nama_peminjam ?? '-' }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $item->alat->nama_alat ?? '-' }}</td>
                                    <td class="px-6 py-4 text-center">{{ $item->jumlah ?? 0 }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                                            @if ($item->status == 'menunggu') bg-yellow-100 text-yellow-700
                                            @elseif ($item->status == 'dipinjam') bg-blue-100 text-blue-700
                                            @else bg-green-100 text-green-700 @endif">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center text-gray-600">
                                        {{ $item->tanggal_pinjam ? \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') : '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-6 text-center text-gray-400">
                                        Belum ada data peminjaman
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Informasi Penting -->
            <div class="bg-blue-50 border-l-4 border-blue-600 rounded-lg p-6">
                <div class="flex items-start gap-4">
                    <div>
                        <h3 class="font-bold text-blue-900">Informasi Penting</h3>
                        <p class="text-blue-800 mt-2">Pastikan selalu memeriksa kondisi alat sebelum diserahkan kepada peminjam dan catat setiap peminjaman dengan detail.</p>
                    </div>
                </div>
            </div>
        </div>

    <!-- Dashboard User -->
    @else
        <div class="space-y-8 px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-indigo-800 rounded-2xl shadow-lg p-8 text-white">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-4xl font-bold tracking-tight">Dashboard Saya</h1>
                        <p class="text-indigo-100 mt-2">Kelola peminjaman alat Anda dengan mudah</p>
                    </div>
                    <div class="flex gap-2">
                        <span class="bg-indigo-500 bg-opacity-50 px-4 py-2 rounded-lg text-sm font-medium">{{ auth()->user()->name }}</span>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Total Peminjaman -->
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden border-l-4 border-indigo-600">
                    <div class="p-6 flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Alat Saya</p>
                            <p class="text-4xl font-bold text-indigo-600 mt-2">{{ $userAlatDipinjam ?? 0 }}</p>
                            <p class="text-xs text-gray-400 mt-3">Sedang dipinjam</p>
                        </div>

                    </div>
                </div>

                <!-- Riwayat Peminjaman -->
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden border-l-4 border-cyan-600">
                    <div class="p-6 flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Riwayat</p>
                            <p class="text-4xl font-bold text-cyan-600 mt-2">{{ $userTotalPeminjaman ?? 0 }}</p>
                            <p class="text-xs text-gray-400 mt-3">Total peminjaman</p>
                        </div>

                    </div>
                </div>

                <!-- Pengajuan Pending -->
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden border-l-4 border-orange-600">
                    <div class="p-6 flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Menunggu</p>
                            <p class="text-4xl font-bold text-orange-600 mt-2">{{ $userPengajuanMenunggu ?? 0 }}</p>
                            <p class="text-xs text-gray-400 mt-3">Menunggu persetujuan</p>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Peminjaman Aktif -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200 p-6">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                        <span class="w-1 h-6 bg-indigo-600 rounded-full"></span>
                        Alat yang Sedang Dipinjam
                    </h2>
                </div>
                <div class="p-6">
                    @forelse ($userPeminjamanAktif ?? [] as $item)
                        <div class="flex items-center justify-between p-4 mb-4 bg-indigo-50 rounded-xl border border-indigo-200 hover:border-indigo-400 transition-colors">
                            <div class="flex-1">
                                <p class="font-bold text-gray-800">{{ $item->alat->nama_alat ?? '-' }}</p>
                                <p class="text-sm text-gray-600 mt-1">Dipinjam: {{ $item->tanggal_pinjam ? \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') : '-' }}</p>
                            </div>
                            <div class="text-right">
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-gray-300 mx-auto mb-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .984.75 1.75 1.972 1.75.23 0 .456-.044.681-.128a2.25 2.25 0 00-1.552-2.558A2.247 2.247 0 0012 3.75zM15 6.75a2.25 2.25 0 012.25 2.25v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 21V9a2.25 2.25 0 012.25-2.25M15 6.75h-3" />
                            </svg>
                            <p class="text-gray-400 font-medium">Anda belum meminjam alat apapun</p>
                            <p class="text-gray-300 text-sm mt-1">Silakan buat pengajuan peminjaman baru</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Riwayat Peminjaman -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200 p-6">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                        <span class="w-1 h-6 bg-cyan-600 rounded-full"></span>
                        Riwayat Peminjaman
                    </h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gradient-to-r from-cyan-600 to-cyan-700 text-white">
                            <tr>
                                <th class="px-6 py-3 text-left">Alat</th>
                                <th class="px-6 py-3 text-center">Jumlah</th>
                                <th class="px-6 py-3 text-center">Tanggal Pinjam</th>
                                <th class="px-6 py-3 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @forelse ($userSemuaPeminjaman ?? [] as $item)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 font-medium text-gray-800">{{ $item->alat->nama_alat ?? '-' }}</td>
                                    <td class="px-6 py-4 text-center">{{ $item->jumlah ?? 0 }}</td>
                                    <td class="px-6 py-4 text-center text-gray-600">
                                        {{ $item->tanggal_pinjam ? \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                                            @if ($item->status == 'menunggu') bg-yellow-100 text-yellow-700
                                            @elseif ($item->status == 'dipinjam') bg-blue-100 text-blue-700
                                            @else bg-green-100 text-green-700 @endif">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-6 text-center text-gray-400">
                                        Belum ada riwayat peminjaman
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    <!-- Success Message -->
    @if (session('success'))
        <div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg animate-fade-in">
            {{ session('success') }}
        </div>
    @endif
</div>

@endsection
