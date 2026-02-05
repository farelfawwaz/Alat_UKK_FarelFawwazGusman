@extends('layouts.app')

@section('title', 'Manajemen Peminjaman')

@section('content')

    <div class="mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    Manajemen Peminjaman
                </h1>
                <p class="text-gray-500 mt-2">
                    Kelola data peminjaman alat
                </p>
            </div>

            <div class="flex flex-col justify-between sm:flex-row items-center gap-3">

                <!-- Form Pencarian -->
                <form method="GET" action="{{ route('peminjaman.index') }}" class="flex items-center gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama peminjam..."
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm">

                    <button type="submit"
                        class="px-4 py-2 text-white bg-blue-400 hover:bg-blue-500 rounded-lg text-sm font-semibold transition">
                        Cari
                    </button>

                    @if (request('search'))
                        <a href="{{ route('peminjaman.index') }}"
                            class="px-3 py-2 bg-red-50 text-red-600 rounded-lg text-sm hover:bg-red-100 transition">
                            Reset
                        </a>
                    @endif
                </form>

                <!-- Tombol Tambah -->
                <a href="{{ route('peminjaman.create') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg shadow hover:shadow-xl transition transform hover:scale-105">
                    Tambah Peminjaman
                </a>

            </div>
        </div>

    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                        <th class="px-6 py-4 text-left">No</th>
                        <th class="px-6 py-4 text-left">Nama Peminjam</th>
                        <th class="px-6 py-4 text-center">Alat</th>
                        <th class="px-6 py-4 text-center">Tanggal Pinjam</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse ($peminjamans as $pinjam)
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
                                @if ($pinjam->status === 'dipinjam')
                                    <span class="bg-yellow-100 text-yellow-700">Dipinjam</span>
                                @else
                                    <span class="bg-green-100 text-green-700">Dikembalikan</span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex flex-wrap justify-center items-center gap-2">

                                    <!-- Detail -->
                                    <a href="{{ route('peminjaman.show', $pinjam->id) }}"
                                        class="inline-flex items-center gap-2 px-3 py-2 text-sm
            bg-indigo-50 text-indigo-600 rounded-lg
            hover:bg-indigo-100 transition shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 5c-7 0-10 7-10 7s3 7 10 7 10-7 10-7-3-7-10-7zm0 11a4 4 0 1 1 0-8 4 4 0 0 1 0 8z" />
                                        </svg>
                                        Detail
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('peminjaman.edit', $pinjam->id) }}"
                                        class="inline-flex items-center gap-2 px-3 py-2 text-sm
            bg-blue-50 text-blue-600 rounded-lg
            hover:bg-blue-100 transition shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2">
                                                <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                <path
                                                    d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
                                            </g>
                                        </svg>
                                        Edit
                                    </a>

                                    <!-- Hapus -->
                                    @if ($pinjam->status === 'dipinjam')

                                    @else
                                        <span class="text-sm text-green-600 font-semibold">
                                             Sudah Dikembalikan
                                        </span>
                                    @endif


                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <p class="text-gray-500">Belum ada data peminjaman</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-8 flex justify-center">
        {{ $peminjamans->withQueryString()->links() }}
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Peminjaman Berhasil',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

@endsection
