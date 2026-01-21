@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')

    <!-- Back Link -->
    <div class="mb-6">
        <a href="{{ route('users.index') }}"
            class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition-colors">
            Kembali ke Daftar Pengguna
        </a>
    </div>

    <!-- Main Container -->
    <div class="max-w-2xl mx-auto">

        <!-- Card Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-t-xl p-8 text-white">
            <h1 class="text-3xl font-bold">Edit Pengguna</h1>
            <p class="text-blue-100 mt-1">Perbarui informasi data pengguna sistem</p>
        </div>

        <!-- Card Body -->
        <div class="bg-white rounded-b-xl shadow-xl p-8 border border-t-0 border-gray-100">
            <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Nama -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg
                    focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none
                    transition-all duration-200 font-medium"
                        placeholder="Masukkan nama lengkap" required>

                    @error('name')
                        <div class="mt-2 p-3 bg-red-50 border-l-4 border-red-500 rounded">
                            <p class="text-sm text-red-700 font-semibold">{{ $message }}</p>
                        </div>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg
                    focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none
                    transition-all duration-200 font-medium"
                        placeholder="masukkan@email.com" required>

                    @error('email')
                        <div class="mt-2 p-3 bg-red-50 border-l-4 border-red-500 rounded">
                            <p class="text-sm text-red-700 font-semibold">{{ $message }}</p>
                        </div>
                    @enderror
                </div>

                <!-- Role -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Role / Peran <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">
                        <select name="role"
                            class="w-full px-4 py-3 pr-12 border-2 border-gray-300 rounded-lg
        focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none
        transition-all duration-200 font-medium bg-white appearance-none"
                            required>
                            <option value="" disabled>Pilih role pengguna</option>

                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
                                Admin - Akses penuh sistem
                            </option>

                            <option value="petugas" {{ $user->role == 'petugas' ? 'selected' : '' }}>
                                Petugas - Kelola operasional
                            </option>

                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>
                                User - Akses terbatas
                            </option>
                        </select>

                        <!-- Arrow Dropdown -->
                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-gray-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>

                    @error('role')
                        <div class="mt-2 p-3 bg-red-50 border-l-4 border-red-500 rounded">
                            <p class="text-sm text-red-700 font-semibold">{{ $message }}</p>
                        </div>
                    @enderror

                    <!-- Role Description -->
                    <div class="mt-3 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <p class="text-xs text-gray-600">
                            <span class="font-semibold text-blue-700">Catatan:</span>
                            <span id="roleDescription" class="ml-1">
                                Admin memiliki akses penuh ke semua fitur sistem
                            </span>
                        </p>
                    </div>
                </div>

                <!-- Divider -->
                <div class="border-t-2 border-gray-200 pt-6"></div>

                <!-- Action -->
                <div class="flex flex-col sm:flex-row gap-3 justify-end">
                    <a href="{{ route('users.index') }}"
                        class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition">
                        Batal
                    </a>

                    <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700
                    text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition transform hover:scale-105">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <!-- Info -->
        <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <p class="text-sm text-gray-700">
                <span class="font-semibold text-blue-700">Informasi Penting:</span>
                Perubahan yang Anda buat akan langsung disimpan ke dalam sistem. Pastikan data sudah benar sebelum
                menyimpan.
            </p>
        </div>
    </div>

    <!-- Role Description Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.querySelector('select[name="role"]');
            const roleDescription = document.getElementById('roleDescription');

            function updateDescription() {
                if (roleSelect.value === 'admin') {
                    roleDescription.textContent =
                        'Admin memiliki akses penuh ke semua fitur sistem dan dapat mengelola pengguna lain.';
                } else if (roleSelect.value === 'petugas') {
                    roleDescription.textContent =
                        'Petugas bertanggung jawab mengelola data operasional seperti peminjaman dan inventaris.';
                } else if (roleSelect.value === 'user') {
                    roleDescription.textContent =
                        'User memiliki akses terbatas dan hanya dapat mengakses fitur umum sistem.';
                }
            }

            roleSelect.addEventListener('change', updateDescription);
            updateDescription();
        });
    </script>

@endsection
