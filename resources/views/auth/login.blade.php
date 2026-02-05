@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <!-- Header Card -->
            <div class="bg-white rounded-t-3xl text-center py-10 pb-4 px-8">
                <div class="mx-auto mb-4 w-16 h-16 flex items-center justify-center rounded-full bg-blue-100">
                    <img src="{{ asset('logo/logo.png') }}" class="w-full h-full object-contain">
                </div>
                <h1 class="text-2xl mt-1 font-bold text-blue-500">Login</h1>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-b-3xl shadow-2xl px-8 py-6">
                <form action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Email Input -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukan Email"
                            class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 placeholder-gray-400
                               focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition"
                            required>
                        @error('email')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Input with Toggle -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" placeholder="Masukan Password"
                                class="w-full px-4 py-3 text-sm rounded-xl border border-gray-300 placeholder-gray-400 pr-12
                                   focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition"
                                required>
                            <!-- Toggle Password Button -->
                            <button type="button" onclick="togglePassword()"
                                class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-blue-600 transition">
                                <!-- Eye Icon Open -->
                                <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hidden"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <!-- Eye Icon Closed -->
                                <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path fill="currentColor" fill-rule="evenodd"
                                        d="m18.67 16.973l2.755 2.755l-.849.848L3.85 3.85L4.697 3l2.855 2.855C8.932 5.303 10.432 5 12 5c4.808 0 8.972 2.848 11 7a12.65 12.65 0 0 1-4.33 4.973M8.486 6.79l1.664 1.664a4 4 0 0 1 5.398 5.398l2.255 2.255c1.574-1 2.904-2.403 3.845-4.106C19.686 8.45 16.034 6.2 12 6.2a10.8 10.8 0 0 0-3.514.59m6.152 6.152a2.8 2.8 0 0 0-3.579-3.579zm1.81 5.204c-1.38.552-2.88.855-4.448.855c-4.808 0-8.972-2.848-11-7a12.65 12.65 0 0 1 4.33-4.973l.867.867A11.36 11.36 0 0 0 2.352 12c1.962 3.55 5.614 5.8 9.648 5.8a10.8 10.8 0 0 0 3.514-.59l.934.935zM8.453 10.15l.909.91a2.8 2.8 0 0 0 3.579 3.579l.91.908a4 4 0 0 1-5.398-5.398z" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full py-3 rounded-xl text-white font-semibold mt-6
                           bg-gradient-to-r from-blue-600 to-blue-700
                           hover:shadow-lg hover:from-blue-700 hover:to-blue-800
                           transition duration-200">
                        Masuk
                    </button>
                </form>

                <!-- Divider -->
                <div class="flex items-center gap-4 my-6">
                    <div class="flex-1 h-px bg-gray-200"></div>
                    <span class="text-xs text-gray-500 font-medium">ATAU</span>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                <!-- Register Link -->
                <p class="text-sm text-center text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:text-blue-700 transition">
                        Daftar Sekarang
                    </a>
                </p>
            </div>

            <!-- Footer -->
            <p class="text-xs text-center text-white mt-6 opacity-80">
                © 2024 Sistem Peminjaman Alat. All rights reserved.
            </p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const eyeOpen = document.getElementById('eyeOpen');
            const eyeClosed = document.getElementById('eyeClosed');

            if (password.type === 'password') {
                password.type = 'text';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            } else {
                password.type = 'password';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            }
        }
    </script>
@endsection
