@extends('layouts.app')

@section('title', 'Persetujuan Peminjaman')

@section('content')

    {{-- HEADER --}}
    <div class="mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    Persetujuan Peminjaman
                </h1>
                <p class="text-gray-500 mt-2">
                    Daftar pengajuan peminjaman yang menunggu persetujuan petugas
                </p>
            </div>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gradient-to-r from-indigo-600 to-indigo-700 text-white">
                        <th class="px-6 py-4 text-left">No</th>
                        <th class="px-6 py-4 text-left">Nama Peminjam</th>
                        <th class="px-6 py-4 text-center">Alat</th>
                        <th class="px-6 py-4 text-center">Tanggal Pengajuan</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse ($peminjaman as $item)
                        <tr class="hover:bg-indigo-50 transition">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 font-semibold">{{ $item->nama_peminjam }}</td>
                            <td class="px-6 py-4 text-center">{{ $item->alat->nama_alat }}</td>
                            <td class="px-6 py-4 text-center">{{ $item->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-center">
                                {{-- DETAIL --}}
                                <a href="{{ route('petugas.peminjaman.show', $item->id) }}"
                                    class="inline-flex items-center gap-2 px-3 py-2 text-sm
                                          bg-indigo-50 text-indigo-600 rounded-lg
                                          hover:bg-indigo-100 transition shadow-sm">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <p class="text-gray-500">Tidak ada pengajuan peminjaman</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ALERT --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

@endsection
