@extends('layouts.app')

@section('title', 'Edit Alat')

@section('content')

    <!-- Back Link -->
    <div class="mb-6">
        <a href="{{ route('alat.index') }}"
            class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition-colors">
            Kembali ke Daftar Alat
        </a>
    </div>

    <!-- Main Container -->
    <div class="max-w-2xl mx-auto">

        <!-- Card Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-t-xl p-8 text-white">
            <h1 class="text-3xl font-bold">Edit Alat</h1>
            <p class="text-blue-100 mt-1">Perbarui informasi data alat</p>
        </div>

        <!-- Card Body -->
        <div class="bg-white rounded-b-xl shadow-xl p-8 border border-t-0 border-gray-100">
            <form action="{{ route('alat.update', $alat->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Nama Alat -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Nama Alat <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_alat" value="{{ old('nama_alat', $alat->nama_alat) }}"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg
                        focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none
                        transition-all duration-200 font-medium"
                        placeholder="Masukkan nama alat" required>
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="kategori" value="{{ old('kategori', $alat->kategori) }}"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg
                        focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none
                        transition-all duration-200 font-medium"
                        placeholder="Masukkan kategori alat" required>
                </div>

                <!-- Stok -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Stok <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="stok" value="{{ old('stok', $alat->stok) }}"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg
                        focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none
                        transition-all duration-200 font-medium"
                        placeholder="Jumlah stok" required>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">
                        <select name="status"
                            class="w-full px-4 py-3 pr-12 border-2 border-gray-300 rounded-lg
                            focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none
                            transition-all duration-200 font-medium bg-white appearance-none"
                            required>
                            <option value="tersedia" {{ $alat->status == 'tersedia' ? 'selected' : '' }}>
                                Tersedia
                            </option>
                            <option value="dipinjam" {{ $alat->status == 'dipinjam' ? 'selected' : '' }}>
                                Dipinjam
                            </option>
                        </select>

                        <!-- Arrow -->
                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-gray-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Deskripsi
                    </label>
                    <textarea name="deskripsi" rows="4"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg
                        focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none
                        transition-all duration-200 font-medium"
                        placeholder="Deskripsi alat">{{ old('deskripsi', $alat->deskripsi) }}</textarea>
                </div>

                <!-- Divider -->
                <div class="border-t-2 border-gray-200 pt-6"></div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 justify-end">
                    <a href="{{ route('alat.index') }}"
                        class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition">
                        Batal
                    </a>

                    <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600
                        hover:from-green-600 hover:to-emerald-700
                        text-white font-semibold rounded-lg shadow-lg
                        hover:shadow-xl transition transform hover:scale-105">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <!-- Info -->
        <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <p class="text-sm text-gray-700">
                <span class="font-semibold text-blue-700">Informasi:</span>
                Perubahan data alat akan langsung tersimpan dan memengaruhi sistem peminjaman.
            </p>
        </div>
    </div>

@endsection
