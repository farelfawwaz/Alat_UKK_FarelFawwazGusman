@extends('layouts.app')

@section('title', 'Tambah Peminjaman')

@section('content')

    <!-- Back Link -->
    <div class="mb-6">
        <a href="{{ route('peminjaman.index') }}"
            class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition-colors">
            Kembali ke Daftar Peminjaman
        </a>
    </div>

    <!-- Main Container -->
    <div class="max-w-2xl mx-auto">

        <!-- Card Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-t-xl p-8 text-white">
            <h1 class="text-3xl font-bold">Tambah Peminjaman</h1>
            <p class="text-blue-100 mt-1">Masukkan data peminjaman alat</p>
        </div>

        <!-- Card Body -->
        <div class="bg-white rounded-b-xl shadow-xl p-8 border border-t-0 border-gray-100">
            <form action="{{ route('peminjaman.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Pilih Alat -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Pilih Alat <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">
                        <select name="alat_id"
                            class="w-full px-4 py-3 pr-10 border-2 border-gray-300 rounded-lg
                            bg-white text-gray-700
                            focus:border-blue-500 focus:ring-2 focus:ring-blue-200
                            outline-none transition-all duration-200 font-medium
                            appearance-none"
                            required>

                            <option value="" disabled selected>
                                -- Pilih Alat --
                            </option>

                            @foreach ($alats as $alat)
                                <option value="{{ $alat->id }}"
                                    {{ old('alat_id') == $alat->id ? 'selected' : '' }}>
                                    {{ $alat->nama_alat }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Arrow -->
                        <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>

                    @error('alat_id')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama Peminjam -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Nama Peminjam <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_peminjam" value="{{ old('nama_peminjam') }}"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg
                        focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none
                        transition-all duration-200 font-medium"
                        placeholder="Masukkan nama peminjam" required>

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
                        transition-all duration-200 font-medium"
                        placeholder="Masukkan alamat peminjam">{{ old('alamat') }}</textarea>
                </div>

                <!-- Nomor Telepon -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Nomor Telepon
                    </label>
                    <input type="text" name="no_telp" value="{{ old('no_telp') }}"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg
                        focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none
                        transition-all duration-200 font-medium"
                        placeholder="">
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

                <!-- Divider -->
                <div class="border-t-2 border-gray-200 pt-6"></div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 justify-end">
                    <a href="{{ route('peminjaman.index') }}"
                        class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition">
                        Batal
                    </a>

                    <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600
                        hover:from-green-600 hover:to-emerald-700
                        text-white font-semibold rounded-lg shadow-lg
                        hover:shadow-xl transition transform hover:scale-105">
                        Simpan Peminjaman
                    </button>
                </div>
            </form>
        </div>

        <!-- Info -->
        <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <p class="text-sm text-gray-700">
                <span class="font-semibold text-blue-700">Informasi:</span>
                Setelah peminjaman disimpan, status alat akan otomatis berubah menjadi
                <span class="font-semibold">Dipinjam</span>.
            </p>
        </div>
    </div>

@endsection
