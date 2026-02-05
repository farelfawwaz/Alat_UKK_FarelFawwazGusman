@extends('layouts.app')

@section('title', 'Daftar Alat')

@section('content')

<div class="mb-8">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                Daftar Alat
            </h1>
            <p class="text-gray-500 mt-2">
                Lihat dan ajukan peminjaman alat
            </p>
        </div>

        <!-- SEARCH -->
        <form method="GET" action="{{ route('user.alat.index') }}" class="flex items-center gap-2">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari alat..."
                class="px-4 py-2 border border-gray-300 rounded-lg
                focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm">

            <button type="submit"
                class="px-4 py-2 bg-blue-500 text-white rounded-lg text-sm font-semibold
                hover:bg-blue-600 transition">
                Cari
            </button>

            @if (request('search'))
                <a href="{{ route('user.alat.index') }}"
                    class="px-3 py-2 bg-red-50 text-red-600 rounded-lg text-sm hover:bg-red-100 transition">
                    Reset
                </a>
            @endif
        </form>

    </div>
</div>

<!-- GRID ALAT -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

    @forelse ($alats as $alat)
        <div class="bg-white rounded-xl shadow hover:shadow-xl transition overflow-hidden">

            <!-- GAMBAR -->
            <div class="h-48 bg-gray-100 flex items-center justify-center">
                @if ($alat->image)
                    <img src="{{ asset('storage/' . $alat->image) }}"
                        class="w-full h-full object-cover">
                @else
                    <span class="text-gray-400 text-sm">Tidak ada gambar</span>
                @endif
            </div>

            <!-- CONTENT -->
            <div class="p-5 space-y-3">

                <h3 class="text-lg font-bold text-gray-800">
                    {{ $alat->nama_alat }}
                </h3>

                <p class="px-3 py-1 w-[90px] text-xs bg-blue-100 text-blue-700 rounded-full">
                    {{ $alat->kategori->name ?? '-' }}
                </p>

                <p class="text-sm text-gray-600 line-clamp-2">
                    {{ $alat->deskripsi }}
                </p>

                <div class="flex items-center justify-between mt-4">

                    <!-- STOK -->
                    @if ($alat->stok > 0)
                        <span class="px-3 py-1 text-xs font-semibold
                            bg-green-100 text-green-700 rounded-full">
                            Stok: {{ $alat->stok }}
                        </span>
                    @else
                        <span class="px-3 py-1 text-xs font-semibold
                            bg-red-100 text-red-700 rounded-full">
                            Stok Habis
                        </span>
                    @endif

                    <!-- AJUKAN -->
                    @if ($alat->stok > 0)
                        <a href="{{ route('user.peminjaman.create', $alat->id) }}"
                            class="px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700
                            text-white text-sm font-semibold rounded-lg
                            hover:scale-105 transition">
                            Ajukan
                        </a>
                    @else
                        <button disabled
                            class="px-4 py-2 bg-gray-300 text-gray-600
                            text-sm rounded-lg cursor-not-allowed">
                            Tidak Tersedia
                        </button>
                    @endif

                </div>

            </div>
        </div>
    @empty
        <div class="col-span-full">
            <div class="bg-white rounded-xl shadow p-10 text-center text-gray-500">
                Tidak ada alat tersedia
            </div>
        </div>
    @endforelse

</div>

<!-- PAGINATION -->
<div class="mt-10 flex justify-center">
    {{ $alats->withQueryString()->links() }}
</div>

@endsection
