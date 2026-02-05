@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')

    <!-- Main Container -->
    <div class="max-w-2xl mx-auto">

        <!-- Card Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-t-xl p-8 text-white">
            <h1 class="text-3xl font-bold">Tambah Kategori</h1>
            <p class="text-blue-100 mt-1">Masukkan data kategori baru ke dalam sistem</p>
        </div>

        <!-- Card Body -->
        <div class="bg-white rounded-b-xl shadow-xl p-8 border border-t-0 border-gray-100">
            <form action="{{ route('kategori.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Nama Kategori -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Nama Kategori
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg
                        focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none
                        transition-all duration-200 font-medium"
                        placeholder="Masukkan nama kategori" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Deskripsi Kategori
                    </label>
                    <input type="text" name="deskripsi" value="{{ old('deskripsi') }}"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg
                        focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none
                        transition-all duration-200 font-medium"
                        placeholder="deskripsi kategori" required>
                </div>

                <!-- Divider -->
                <div class="border-t-2 border-gray-200 pt-6"></div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 justify-end">
                    <a href="{{ route('kategori.index') }}"
                        class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition">
                        Batal
                    </a>

                    <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600
                        hover:from-green-600 hover:to-emerald-700
                        text-white font-semibold rounded-lg shadow-lg
                        hover:shadow-xl transition transform hover:scale-105">
                        Simpan Kategori
                    </button>
                </div>
            </form>
        </div>

        <!-- Info -->
        <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <p class="text-sm text-gray-700">
                <span class="font-semibold text-blue-700">Informasi:</span>
                Kategori yang ditambahkan akan digunakan untuk pengelompokan data alat.
            </p>
        </div>
    </div>

@endsection
