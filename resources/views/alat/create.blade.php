@extends('layouts.app')

@section('title', 'Tambah Alat')

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
            <h1 class="text-3xl font-bold">Tambah Alat</h1>
            <p class="text-blue-100 mt-1">Masukkan data alat baru ke dalam sistem</p>
        </div>

        <!-- Card Body -->
        <div class="bg-white rounded-b-xl shadow-xl p-8 border border-t-0 border-gray-100">
            <form action="{{ route('alat.store') }}" method="POST" class="space-y-6">
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
                    <input type="text" name="kategori" value="{{ old('kategori') }}"
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

@endsection



{{-- Nama Alat	Kode Alat	Stok	Deskripsi
Bor Listrik	BOR-001	     5	       Bor listrik untuk kayu dan besi
Bor Beton	BOR-002	     3	       Bor beton untuk pekerjaan konstruksi
Bor Tangan	BOR-003	     4	       Bor manual untuk pekerjaan ringan

⚙️ Kategori: Gerinda
Nama Alat	   Kode Alat	Stok	        Deskripsi
Gerinda Tangan	GRN-001	     6	       Gerinda untuk memotong besi
Gerinda Duduk	GRN-002	     2	       Gerinda duduk untuk bengkel

🔨 Kategori: Alat Tangan
Nama Alat	Kode Alat	Stok	Deskripsi
Palu Besi	    PL-001	 10	    Palu besi untuk konstruksi
Kunci Inggris	KI-001	 8	    Kunci inggris serbaguna
Obeng Set	    OB-001	 12	    et obeng plus dan minus

🏗️ Kategori: Alat Proyek
Nama Alat	  KodeAlat	     Stok	           Deskripsi
Mesin Molen	   MOL-001	       2	        Mesin pengaduk semen
Jack Hammer	   JH-001	       1	        Alat pemecah beton
Compressor	   CMP-001	       2	        Mesin kompresor udara --}}
