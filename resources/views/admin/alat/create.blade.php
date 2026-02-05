@extends('layouts.app')

@section('title', 'Tambah Alat')

@section('content')

    <!-- Back Link -->
    <div class="mb-6">
        <a href="{{ route('admin.alat.index') }}"
            class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition-colors">
            Kembali ke Daftar Alat
        </a>
    </div>

    <!-- Main Container -->
    <div class="max-w-2xl mx-auto">

        <!-- Card Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-t-xl p-8 text-white">
            <h1 class="text-3xl font-bold">Tambah Alat</h1>
            <p class="text-blue-100 mt-1">Masukkan data alat baru ke dalam sistem</p>
        </div>

        <!-- Card Body -->
        <div class="bg-white rounded-b-xl shadow-xl p-8 border border-t-0 border-gray-100">
            <form action="{{ route('admin.alat.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Nama Alat -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Nama Alat <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_alat" value="{{ old('nama_alat') }}"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg
                        focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none
                        transition-all duration-200 font-medium"
                        placeholder="Masukkan nama alat" required>
                </div>

                <!-- Kode Alat -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Kode Alat <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="kode_alat" value="{{ old('kode_alat') }}"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg
                        focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none
                        transition-all duration-200 font-medium"
                        placeholder="Contoh: ALT-001" required>
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">
                        <select name="kategori_id"
                            class="w-full px-4 py-3 pr-10 border-2 border-gray-300 rounded-lg
               bg-white text-gray-700
               focus:border-blue-500 focus:ring-2 focus:ring-blue-200
               outline-none transition-all duration-200 font-medium
               appearance-none"
                            required>

                            <option value="" disabled selected class="text-gray-400">
                                -- Pilih Kategori --
                            </option>

                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}" {{ old('kategori_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Custom Arrow -->
                        <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>


                    @error('kategori_id')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <!-- Stok -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Stok <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="stok" value="{{ old('stok') }}"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg
                        focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none
                        transition-all duration-200 font-medium"
                        placeholder="Jumlah stok" required>
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
                        placeholder="Deskripsi singkat alat">{{ old('deskripsi') }}</textarea>
                </div>

                <!-- Image Alat -->
                <!-- Gambar Alat -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Gambar Alat
                    </label>

                    <!-- Preview -->
                    <div class="mb-3">
                        <img id="preview-image" src="https://via.placeholder.com/300x200?text=Preview+Image"
                            class="w-full max-w-sm h-48 object-cover rounded-lg border border-gray-300">
                    </div>

                    <!-- Input File -->
                    <input type="file" name="image" accept="image/*" onchange="previewImage(event)"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg
        focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none
        transition-all duration-200 font-medium bg-white">

                    <p class="text-xs text-gray-500 mt-1">
                        Format: JPG, PNG, JPEG • Maks 2MB
                    </p>

                    @error('image')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Divider -->
                <div class="border-t-2 border-gray-200 pt-6"></div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 justify-end">
                    <a href="{{ route('admin.alat.index') }}"
                        class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition">
                        Batal
                    </a>

                    <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600
                        hover:from-green-600 hover:to-emerald-700
                        text-white font-semibold rounded-lg shadow-lg
                        hover:shadow-xl transition transform hover:scale-105">
                        Simpan Alat
                    </button>
                </div>
            </form>
        </div>

        <!-- Info -->
        <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <p class="text-sm text-gray-700">
                <span class="font-semibold text-blue-700">Informasi:</span>
                Data alat yang ditambahkan akan langsung tersimpan dan dapat digunakan untuk proses peminjaman.
            </p>
        </div>
    </div>

    @push('scripts')
        <script>
            function previewImage(event) {
                const image = document.getElementById('preview-image');
                image.src = URL.createObjectURL(event.target.files[0]);
                image.onload = () => URL.revokeObjectURL(image.src);
            }
        </script>
    @endpush


@endsection
