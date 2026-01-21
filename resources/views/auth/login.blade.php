@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white shadow-xl rounded-2xl p-8 md:p-10">
        
        <!-- Judul -->
        <h1 class="text-3xl font-bold text-center text-gray-800">
            Selamat Datang
        </h1>
        <p class="text-center text-gray-500 mt-2 mb-8 text-sm">
            Silakan masuk untuk melanjutkan ke dashboard Anda
        </p>

        <!-- Form -->
        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf

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

            <!-- Button -->
            <button
                type="submit"
                class="w-full bg-blue-600 text-white font-semibold py-2.5 rounded-lg
                       hover:bg-blue-700 transition duration-200"
            >
                Login
            </button>
        </form>

        <!-- Register -->
        <p class="text-sm text-center text-gray-500 mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}"
               class="text-blue-600 hover:underline font-medium">
                Daftar Sekarang
            </a>
        </p>
    </div>
</div>
@endsection
