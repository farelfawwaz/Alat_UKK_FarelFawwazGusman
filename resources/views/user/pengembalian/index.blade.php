@extends('layouts.app')

@section('title', 'Pengembalian Alat')

@section('content')

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Pengembalian Alat</h1>
        <p class="text-gray-500 mt-2">Alat yang sedang Anda pinjam</p>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                <tr>
                    <th class="px-6 py-3 text-left">Alat</th>
                    <th class="px-6 py-3 text-center">Tanggal Pinjam</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse ($peminjamans as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-semibold">
                            {{ $item->alat->nama_alat }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            @if ($item->status === 'disetujui')
                                <form action="{{ route('user.pengembalian.store', $item->id) }}" method="POST">
                                    @csrf
                                    <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                                        Kembalikan
                                    </button>
                                </form>
                            @else
                                <button class="px-4 py-2 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed" disabled>
                                    Tidak tersedia
                                </button>
                            @endif
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-10 text-center text-gray-500">
                            Tidak ada alat yang sedang dipinjam
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
