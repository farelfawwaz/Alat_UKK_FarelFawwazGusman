@extends('layouts.app')

@section('title', 'Ajukan Peminjaman')

@section('content')

    <!-- Back Link -->
    <div class="mb-6">
        <a href="{{ route('user.alat.index') }}"
            class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition-colors">
            Kembali ke Daftar Alat
        </a>
    </div>

    <!-- Main Container -->
    <div class="max-w-2xl mx-auto">

        <!-- Card Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-t-xl p-8 text-white">
            <h1 class="text-3xl font-bold">Ajukan Peminjaman</h1>
            <p class="text-blue-100 mt-1">Lengkapi data untuk meminjam alat</p>
        </div>

        <!-- Card Body -->
        <div class="bg-white rounded-b-xl shadow-xl p-8 border border-t-0 border-gray-100">

            <!-- INFO ALAT -->
            <div class="mb-6 flex items-center gap-5 p-4 bg-gray-50 rounded-lg border">
                <div class="w-24 h-20 bg-gray-200 rounded overflow-hidden">
                    @if ($alat->image)
                        <img src="{{ asset('storage/' . $alat->image) }}" class="w-full h-full object-cover">
                    @else
                        <div class="flex items-center justify-center h-full text-xs text-gray-400">
                            No Image
                        </div>
                    @endif
                </div>

                <div>
                    <h2 class="font-bold text-lg text-gray-800">
                        {{ $alat->nama_alat }}
                    </h2>
                    <p class="text-sm text-gray-500">
                        {{ $alat->kategori->name ?? '-' }}
                    </p>
                    <span
                        class="inline-block mt-2 px-3 py-1 text-xs font-semibold
                        bg-green-100 text-green-700 rounded-full">
                        Stok: {{ $alat->stok }}
                    </span>
                </div>
            </div>

            <!-- FORM -->
            <form action="{{ route('user.peminjaman.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Hidden alat -->
                <input type="hidden" name="alat_id" value="{{ $alat->id }}">

                <!-- Nama Peminjam -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Nama Peminjam <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_peminjam" value="{{ old('nama_peminjam', auth()->user()->name) }}"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg
                        focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none
                        transition-all duration-200 font-medium"
                        required>

                    @error('nama_peminjam')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alamat -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Alamat
                    </label>
                    <textarea name="alamat" rows="3"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg
                        focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none
                        transition-all duration-200 font-medium">{{ old('alamat') }}</textarea>
                </div>

                <!-- Nomor Telepon -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Nomor Telepon
                    </label>
                    <input type="text" name="no_telp" value="{{ old('no_telp') }}"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg
                        focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none
                        transition-all duration-200 font-medium">
                </div>

                <!-- Tanggal Pinjam -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Tanggal Pinjam <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="tanggal_pinjam" value="{{ old('tanggal_pinjam') }}"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg
                        focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none
                        transition-all duration-200 font-medium"
                        required>
                </div>

                <!-- Jumlah Pinjam -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Jumlah Pinjam <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="jumlah" value="{{ old('jumlah') }}" min="1"
                        max="{{ $alat->stok }}"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg
        focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none
        transition-all duration-200 font-medium"
                        required>

                    <p class="text-xs text-gray-500 mt-1">
                        Maksimal: {{ $alat->stok }} unit
                    </p>

                    @error('jumlah')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Divider -->
                <div class="border-t-2 border-gray-200 pt-6"></div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 justify-end">
                    <a href="{{ route('user.alat.index') }}"
                        class="px-6 py-3 bg-gray-200 hover:bg-gray-300
                        text-gray-800 font-semibold rounded-lg transition">
                        Batal
                    </a>

                    <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600
                        hover:from-green-600 hover:to-emerald-700
                        text-white font-semibold rounded-lg shadow-lg
                        hover:shadow-xl transition transform hover:scale-105">
                        Ajukan Peminjaman
                    </button>
                </div>
            </form>
        </div>

        <!-- Info -->
        <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <p class="text-sm text-gray-700">
                <span class="font-semibold text-blue-700">Informasi:</span>
                Setelah pengajuan dikirim, stok alat akan otomatis berkurang dan
                status peminjaman menjadi <span class="font-semibold">Dipinjam</span>.
            </p>
        </div>
    </div>

@endsection
