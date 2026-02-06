<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/output.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.png') }}">
</head>

<body class="bg-gray-100 min-h-screen flex">

    <!-- Sidebar -->
    <aside x-data="{ loaded: false }" x-init="setTimeout(() => loaded = true, 50)"
        :class="loaded ? 'translate-x-0 opacity-100' : '-translate-x-full opacity-0'"
        class="w-64 bg-gradient-to-b from-blue-600 to-indigo-700 text-white flex flex-col
           fixed h-screen transform transition-all duration-500 ease-out
           print:hidden">


        <!-- Brand -->
        <div class="flex items-center space-x-3 px-6 py-5 border-b border-white/20">
            <div class="w-10 h-10 rounded-lg overflow-hidden flex items-center justify-center">
                <img src="{{ asset('logo/logo.png') }}" class="w-full h-full object-contain">
            </div>
            <span class="font-semibold text-lg">Peminjaman Alat</span>
        </div>

        @php
            $menu = 'group flex items-center gap-3 px-4 py-2 rounded-lg
                     transition-all duration-200
                     hover:bg-white/20 hover:translate-x-1';

            $icon = 'w-5 h-5 text-white/80 transition-transform duration-200
                     group-hover:scale-110';
        @endphp

        <!-- Menu -->
        <nav class="flex-1 px-4 py-6 space-y-2 text-sm font-medium">

            <!-- Dashboard (SEMUA ROLE) -->
            <a href="{{ route('dashboard') }}" class="{{ $menu }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M22.262 10.468c-3.39-2.854-9.546-8.171-9.607-8.225L12 1.68l-.652.563c-.062.053-6.221 5.368-9.66 8.248A2.04 2.04 0 0 0 1 12a2 2 0 0 0 2 2h1v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-6h1a2 2 0 0 0 2-2c0-.598-.275-1.161-.738-1.532" />
                </svg>
                <span>Dashboard</span>
            </a>

            {{-- ================= ADMIN ================= --}}
            @if (auth()->user()->role === 'admin')
                <a href="{{ route('admin.users.index') }}" class="{{ $menu }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <g fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="7" r="4" />
                            <path d="M5.5 21a6.5 6.5 0 0 1 13 0" />
                        </g>
                    </svg>
                    <span>Pengguna</span>
                </a>

                <a href="{{ route('admin.kategori.index') }}" class="{{ $menu }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M10 3H4v6h6zm10 0h-6v6h6zM10 13H4v6h6zm8 0a4 4 0 1 0 0 8a4 4 0 0 0 0-8" />
                    </svg>
                    <span>Kategori</span>
                </a>

                <a href="{{ route('admin.alat.index') }}" class="{{ $menu }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                        <path fill="currentColor" d="M15.1 3.12a1 1 0 0 1 .706.71c.452 1.71.032 3.62-1.32 4.97" />
                    </svg>
                    <span>Alat</span>
                </a>

                <a href="{{ route('admin.peminjaman.index') }}" class="{{ $menu }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M11.825 6.455a3 3 0 0 0-3.626.211L5.45 7.796" />
                    </svg>
                    <span>Peminjaman</span>
                </a>

                <a href="{{ route('admin.pengembalian.index') }}" class="{{ $menu }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-width="2" d="m9 19l-5-5l5-5m9-5v10H5" />
                    </svg>
                    <span>Pengembalian</span>
                </a>

                <a href="{{ route('admin.aktivity.index') }}" class="{{ $menu }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                        <path fill="currentColor" d="M2.5 13h-2m12 0h-10m-3-3h-2m12 0h-10" />
                    </svg>
                    <span>Log Aktivitas</span>
                </a>
            @endif

            {{-- ================= PETUGAS ================= --}}
            @if (auth()->user()->role === 'petugas')
                <a href="{{ route('petugas.peminjaman.index') }}" class="{{ $menu }}">
                    <span>Persetujuan Peminjaman</span>
                </a>

                <a href="{{ Route('petugas.pengembalian.index') }}" class="{{ $menu }}">
                    <span>Monitoring Pengembalian</span>
                </a>

                <a href="{{ Route('petugas.laporan.index') }}" class="{{ $menu }}">
                    <span>Laporan</span>
                </a>
            @endif

            {{-- ================= USER ================= --}}
            @if (auth()->user()->role === 'user')
                <a href="{{ route('user.alat.index') }}" class="{{ $menu }}">
                    <span>Daftar Alat</span>
                </a>

                <a href="{{ route('user.peminjaman.index') }}" class="{{ $menu }}">
                    <span>Ajukan Peminjaman</span>
                </a>

                <a href="{{ route('user.pengembalian.index') }}" class="{{ $menu }}">
                    <span>Pengembalian</span>
                </a>
            @endif
        </nav>

        @auth
            <div x-data="{ open: false }" class="px-4 py-4 border-t border-white/20 relative">
                <button @click="open = !open"
                    class="w-full flex items-center gap-3 p-3 bg-white/10 rounded-lg hover:bg-white/20 transition">
                    <div class="w-9 h-9 rounded-full bg-pink-400 flex items-center justify-center font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="flex-1 text-left">
                        <p class="text-sm font-semibold">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-300">{{ auth()->user()->role }}</p>
                    </div>
                </button>

                <div x-show="open" @click.outside="open=false"
                    class="absolute bottom-20 left-4 right-4 bg-white rounded-xl shadow-lg p-3 text-gray-700">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="w-full text-red-600 text-sm">Logout</button>
                    </form>
                </div>
            </div>
        @endauth

    </aside>

    <!-- Content -->
    <main class="ml-64 w-full p-6">
        @yield('content')
    </main>

    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        @media print {
            body {
                background: white;
            }

            main {
                margin-left: 0 !important;
                padding: 0 !important;
            }

            .print\:hidden {
                display: none !important;
            }
        }
    </style>

</body>

</html>
