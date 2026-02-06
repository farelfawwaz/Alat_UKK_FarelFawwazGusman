@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')

<div class="min-h-screen bg-slate-50 py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-800">
                    Detail Peminjaman
                </h1>
                <p class="text-slate-500 mt-1">
                    Informasi lengkap data peminjaman alat
                </p>
            </div>

            <a href="{{ route('petugas.peminjaman.index') }}"
                class="px-5 py-2.5 bg-white border border-slate-300 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-100 transition">
                ← Kembali
            </a>
        </div>

        <!-- MAIN CARD -->
        <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-10 space-y-10">

            <!-- STATUS -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl p-6 text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm opacity-90">Status Peminjaman</p>
                        <h2 class="text-xl font-bold">
                            @if ($peminjaman->status == 'menunggu')
                                Menunggu
                            @elseif($peminjaman->status == 'dipinjam')
                                Dipinjam
                            @elseif($peminjaman->status == 'dikembalikan')
                                Dikembalikan
                            @else
                                {{ ucfirst($peminjaman->status) }}
                            @endif
                        </h2>
                    </div>
                </div>
            </div>

            <!-- DATA PEMINJAM -->
            <div>
                <h2 class="text-lg font-bold text-blue-700 mb-6 border-b pb-3">
                    Data Peminjam
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div>
                        <p class="text-sm text-slate-500 mb-2">Nama Peminjam</p>
                        <div class="px-4 py-3 bg-slate-50 rounded-lg border">
                            {{ $peminjaman->nama_peminjam }}
                        </div>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500 mb-2">Nomor Telepon</p>
                        <div class="px-4 py-3 bg-slate-50 rounded-lg border">
                            {{ $peminjaman->no_telp ?? '-' }}
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-sm text-slate-500 mb-2">Alamat</p>
                        <div class="px-4 py-3 bg-slate-50 rounded-lg border min-h-[80px]">
                            {{ $peminjaman->alamat ?? '-' }}
                        </div>
                    </div>

                </div>
            </div>

            <!-- DATA ALAT -->
            <div>
                <h2 class="text-lg font-bold text-blue-700 mb-6 border-b pb-3">
                    Data Alat
                </h2>

                <div>
                    <p class="text-sm text-slate-500 mb-2">Nama Alat</p>
                    <div class="px-4 py-3 bg-slate-50 rounded-lg border">
                        {{ $peminjaman->alat->nama_alat }}
                    </div>
                </div>
            </div>

            <!-- INFORMASI TANGGAL -->
            <div>
                <h2 class="text-lg font-bold text-blue-700 mb-6 border-b pb-3">
                    Informasi Tanggal
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div>
                        <p class="text-sm text-slate-500 mb-2">Tanggal Pinjam</p>
                        <div class="px-4 py-3 bg-slate-50 rounded-lg border">
                            {{ $peminjaman->tanggal_pinjam->format('d M Y') }}
                        </div>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500 mb-2">Tanggal Kembali</p>
                        <div class="px-4 py-3 bg-slate-50 rounded-lg border">
                            {{ $peminjaman->tanggal_kembali ? $peminjaman->tanggal_kembali->format('d M Y') : '-' }}
                        </div>
                    </div>

                </div>
            </div>

            <!-- ACTION BUTTON -->
            @if ($peminjaman->status == 'menunggu')
                <div class="pt-6 border-t flex justify-end gap-4">
                    <form action="{{ route('petugas.peminjaman.setujui', $peminjaman->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow transition text-sm">
                            Setujui
                        </button>
                    </form>

                    <form action="{{ route('petugas.peminjaman.tolak', $peminjaman->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow transition text-sm">
                            Tolak
                        </button>
                    </form>
                </div>
            @endif

        </div>

    </div>
</div>

@endsection
