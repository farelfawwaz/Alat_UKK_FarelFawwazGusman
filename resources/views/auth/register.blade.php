@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white shadow-xl rounded-2xl p-8 md:p-10">

        <!-- Title -->
        <h1 class="text-3xl font-bold text-center text-gray-800">
            Buat Akun
        </h1>
        <p class="text-center text-gray-500 mt-2 mb-8 text-sm">
            Silakan isi data untuk membuat akun baru
        </p>

        <!-- Form -->
        <form action="{{ route('register') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nama Lengkap
                </label>
                <input
                    type="text"
                    name="name"
                    placeholder="Nama Lengkap"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm
                           focus:border-blue-500 focus:ring focus:ring-blue-200 focus:outline-none"
                    required
                >
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email
                </label>
                <input
                    type="email"
                    name="email"
                    placeholder="email@example.com"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm
                           focus:border-blue-500 focus:ring focus:ring-blue-200 focus:outline-none"
                    required
                >
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Password
                </label>
                <input
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm
                           focus:border-blue-500 focus:ring focus:ring-blue-200 focus:outline-none"
                    required
                >
            </div>

            <!-- Confirm Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Konfirmasi Password
                </label>
                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="••••••••"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm
                           focus:border-blue-500 focus:ring focus:ring-blue-200 focus:outline-none"
                    required
                >
            </div>

            <!-- Button -->
            <button
                type="submit"
                class="w-full bg-blue-600 text-white font-semibold py-2.5 rounded-lg
                       hover:bg-blue-700 transition duration-200"
            >
                Daftar
            </button>
        </form>

        <!-- Login -->
        <p class="text-sm text-center text-gray-500 mt-6">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-medium">
                Login
            </a>
        </p>

    </div>
</div>
@endsection
