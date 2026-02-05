@extends('layouts.app')

@section('title', 'Edit Peminjaman')

@section('content')

    <!-- Main Container -->
    <div class="max-w-2xl mx-auto">

        <!-- Card Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-t-xl p-8 text-white">
            <h1 class="text-3xl font-bold">Edit Peminjaman</h1>
            <p class="text-blue-100 mt-1">Perbarui data peminjaman alat</p>
        </div>

        <!-- Card Body -->
        <div class="bg-white rounded-b-xl shadow-xl p-8 border border-t-0 border-gray-100">
            <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Pilih Alat -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Pilih Alat <span class="text-red-500">*</span>
                    </label>

                    <select name="alat_id"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg
                        focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all"
                        required>

                        @foreach ($alats as $alat)
                            <option value="{{ $alat->id }}"
                                {{ old('alat_id', $peminjaman->alat_id) == $alat->id ? 'selected' : '' }}>
                                {{ $alat->nama_alat }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Nama Peminjam -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Nama Peminjam <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_peminjam"
                        value="{{ old('nama_peminjam', $peminjaman->nama_peminjam) }}"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg
                        focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all"
                        required>
                </div>

                <!-- Alamat -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Alamat
                    </label>
                    <textarea name="alamat" rows="3"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg
                        focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all">{{ old('alamat', $peminjaman->alamat) }}</textarea>
                </div>

                <!-- Nomor Telepon -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Nomor Telepon
                    </label>
                    <input type="text" name="no_telp" value="{{ old('no_telp', $peminjaman->no_telp) }}"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg
                        focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all">
                </div>

                <!-- Tanggal Pinjam -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Tanggal Pinjam <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="tanggal_pinjam"
                        value="{{ old('tanggal_pinjam', \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('Y-m-d')) }}"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg" required>

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
                        class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700
                        hover:from-blue-700 hover:to-blue-800
                        text-white font-semibold rounded-lg shadow-lg
                        hover:shadow-xl transition transform hover:scale-105">
                        Update Data
                    </button>
                </div>
            </form>
        </div>

        <!-- Info -->
        <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <p class="text-sm text-gray-700">
                <span class="font-semibold text-blue-700">Informasi:</span>
                Pastikan data yang diperbarui sudah sesuai sebelum menyimpan perubahan.
            </p>
        </div>

    </div>

@endsection
