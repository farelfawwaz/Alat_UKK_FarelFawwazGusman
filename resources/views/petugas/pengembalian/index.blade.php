@extends('layouts.app')

@section('title', 'Monitoring Pengembalian')

@section('content')

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">
            Monitoring Pengembalian
        </h1>
        <p class="text-gray-500 mt-2">
            Daftar alat yang telah dikembalikan oleh peminjam
        </p>
    </div>

    <form method="GET" class="mb-6 p-4 rounded-xl flex flex-wrap gap-4">
        <div>
            <label class="text-sm text-gray-600">Dari Tanggal</label>
            <input type="date" name="from" value="{{ request('from') }}"
                class="block mt-1 border rounded-lg px-3 py-2 text-sm">
        </div>

        <div>
            <label class="text-sm text-gray-600">Sampai Tanggal</label>
            <input type="date" name="to" value="{{ request('to') }}"
                class="block mt-1 border rounded-lg px-3 py-2 text-sm">
        </div>

        <div class="flex items-end gap-2">
            <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">
                Filter
            </button>

            <a href="{{ route('petugas.pengembalian.index') }}"
                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                Reset
            </a>
        </div>
    </form>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gradient-to-r from-emerald-600 to-emerald-700 text-white">
                <tr>
                    <th class="px-6 py-3 text-left">Nama Peminjam</th>
                    <th class="px-6 py-3 text-left">Nama Alat</th>
                    <th class="px-6 py-3 text-center">Tanggal Pinjam</th>
                    <th class="px-6 py-3 text-center">Tanggal Kembali</th>
                    <th class="px-6 py-3 text-center">Status</th>
                    <th class="px-6 py-3 text-center">Detail</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse ($peminjamans as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-semibold">
                            {{ $item->nama_peminjam }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $item->alat->nama_alat }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            <span
                                class="px-3 py-1 rounded-full text-xs font-semibold
                            bg-green-100 text-green-700">
                                Dikembalikan
                            </span>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('petugas.peminjaman.show', $item->id) }}"
                                class="px-3 py-2 text-sm bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100">
                                Detail
                            </a>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                            Belum ada pengembalian alat
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $peminjamans->links() }}
    </div>

@endsection
