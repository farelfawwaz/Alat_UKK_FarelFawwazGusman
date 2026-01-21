<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/output.css') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.png') }}">
</head>

<body class="bg-gray-100 min-h-screen">

    <nav class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between h-16">

                <!-- Brand -->
                <div class="flex items-center space-x-2">
                    <div class="w-9 h-9 flex items-center justify-center rounded-lg shadow overflow-hidden">
                        <img src="{{ asset('logo/logo.png') }}" alt="Logo" class="w-full h-full object-contain">
                    </div>

                    <span class="font-semibold text-lg tracking-wide">
                        Peminjaman Alat
                    </span>
                </div>

                <!-- Menu -->
                <ul class="hidden md:flex items-center space-x-8 text-sm font-medium">
                    @php
                        $menuClass =
                            'relative after:absolute after:-bottom-1 after:left-0 after:h-0.5 after:w-0 after:bg-white after:transition-all hover:after:w-full';
                    @endphp

                    <li>
                        <a href="{{ route('dashboard') }}" class="{{ $menuClass }}">
                            Dashboard
                        </a>
                    </li>
                    <a href="{{ route('users.index') }}" class="{{ $menuClass }} hover:text-blue-200">
                        Pengguna
                    </a>
                    <a href="{{ route('alat.index') }}" class="{{ $menuClass }} hover:text-blue-200">
                        Alat
                    </a>
                    <li><a href="#" class="{{ $menuClass }}">Kategori</a></li>
                    <li><a href="#" class="{{ $menuClass }}">Peminjaman</a></li>
                    <li><a href="#" class="{{ $menuClass }}">Pengembalian</a></li>
                    <li><a href="#" class="{{ $menuClass }}">Log Aktivitas</a></li>
                </ul>

                <!-- Auth -->
                <div class="flex items-center space-x-4 text-sm">
                    @auth
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span class="hidden sm:block font-medium">
                                {{ auth()->user()->name }}
                            </span>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg transition shadow">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="hover:underline">
                            Login
                        </a>
                        <a href="{{ route('register') }}"
                            class="bg-white text-blue-600 px-4 py-2 rounded-lg shadow hover:bg-gray-100 transition">
                            Register
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </nav>


    <!-- Content -->
    <main class="container mx-auto px-4 mt-8">
        @yield('content')
    </main>

</body>

</html>
