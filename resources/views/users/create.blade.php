@extends('layouts.app')

@section('title', 'Tambah Pengguna')

@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <!-- Header -->
        <div class="px-6 py-5 border-b">
            <h1 class="text-xl font-semibold text-gray-800">Tambah Pengguna</h1>
            <p class="text-sm text-gray-500 mt-1">
                Lengkapi data pengguna baru di bawah ini
            </p>
        </div>

        <!-- Form -->
        <form action="{{ route('users.store') }}" method="POST" class="p-6 space-y-5">
            @csrf

            <!-- Nama -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nama Lengkap
                </label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama lengkap"
                    class="w-full rounded-lg border-gray-300 px-4 py-2.5
                           focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none"
                    required>
                @error('name')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email
                </label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="contoh@email.com"
                    class="w-full rounded-lg border-gray-300 px-4 py-2.5
                           focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none"
                    required>
                @error('email')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Password
                </label>
                <input
                    type="password"
                    name="password"
                    placeholder="Minimal 8 karakter"
                    class="w-full rounded-lg border-gray-300 px-4 py-2.5
                           focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none"
                    required>
                @error('password')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Role
                </label>
                <select
                    name="role"
                    class="w-full rounded-lg border-gray-300 px-4 py-2.5
                           focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none"
                    required>
                    <option value="">-- Pilih Role --</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
                @error('role')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action -->
            <div class="flex justify-end gap-3 pt-6 border-t">
                <a href="{{ route('users.index') }}"
                   class="px-4 py-2.5 rounded-lg bg-gray-100 text-gray-700
                          hover:bg-gray-200 transition">
                    Batal
                </a>
                <button
                    type="submit"
                    class="px-5 py-2.5 rounded-lg bg-blue-600 text-white font-medium
                           hover:bg-blue-700 shadow-sm transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
