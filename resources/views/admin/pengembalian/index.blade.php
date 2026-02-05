@extends('layouts.app')

@section('title', 'Pengembalian Alat')

@section('content')

    {{-- HEADER --}}
    <div class="mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    Manajemen Pengembalian
                </h1>
                <p class="text-gray-500 mt-2">
                <p class="text-gray-500 mt-2">
                    Daftar alat yang masih dipinjam dan siap dikembalikan
                </p>

                </p>
            </div>
        </div>
    </div>

    {{-- ALERT --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Alat Berhasil Kembalikan',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    {{-- TABLE CARD --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                        <th class="px-6 py-4 text-left">No</th>
                        <th class="px-6 py-4 text-left">Nama Peminjam</th>
                        <th class="px-6 py-4 text-center">Alat</th>
                        <th class="px-6 py-4 text-center">Tanggal Pinjam</th>
                        <th class="px-6 py-4 text-center">Tanggal Kembali</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>

                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse ($peminjaman as $pinjam)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4 font-semibold">
                                {{ $pinjam->nama_peminjam }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                {{ $pinjam->alat->nama_alat }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                {{ $pinjam->tanggal_pinjam->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                {{ $pinjam->tanggal_kembali?->format('d M Y') ?? '-' }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if ($pinjam->status === 'dipinjam')
                                    <span
                                        class="inline-flex px-3 py-1 rounded-full text-xs font-semibold
            bg-yellow-100 text-yellow-700">
                                        Dipinjam
                                    </span>
                                @else
                                    <span
                                        class="inline-flex px-3 py-1 rounded-full text-xs font-semibold
            bg-green-100 text-green-700">
                                        Dikembalikan
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if ($pinjam->status === 'dipinjam')
                                    <form action="{{ route('pengembalian.kembalikan', $pinjam->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin alat ini dikembalikan?')">
                                        @csrf
                                        <button
                                            class="inline-flex items-center gap-2 px-3 py-2 text-sm
        bg-green-50 text-green-600 rounded-lg
        hover:bg-green-100 transition shadow-sm">
                                            🔁 Kembalikan
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-400 text-sm">-</span>
                                @endif
                            </td>


                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <p class="text-gray-500">Belum ada alat yang dikembalikan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
