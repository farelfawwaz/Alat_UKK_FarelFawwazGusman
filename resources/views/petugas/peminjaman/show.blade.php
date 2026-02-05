@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow p-6 space-y-5">

        <h2 class="text-xl font-bold">Detail Peminjaman</h2>

        <div class="space-y-2 text-sm">
            <p><strong>Nama:</strong> {{ $peminjaman->user->name }}</p>
            <p><strong>Alat:</strong> {{ $peminjaman->alat->nama }}</p>
            <p><strong>Jumlah:</strong> {{ $peminjaman->jumlah }}</p>
            <p><strong>Tanggal Pinjam:</strong> {{ $peminjaman->tanggal_pinjam }}</p>
            <p>
                <strong>Status:</strong>
                <span class="px-2 py-1 bg-yellow-500 text-white rounded text-xs">
                    Pending
                </span>
            </p>
        </div>

        <div class="flex gap-3 pt-4">
            <form action="{{ route('petugas.peminjaman.approve', $peminjaman->id) }}" method="POST">
                @csrf
                @method('PUT')
                <button
                    onclick="return confirm('Setujui peminjaman ini?')"
                    class="px-5 py-2 bg-green-600 text-white rounded-lg">
                    Setujui
                </button>
            </form>

            <form action="{{ route('petugas.peminjaman.reject', $peminjaman->id) }}" method="POST">
                @csrf
                @method('PUT')
                <button
                    onclick="return confirm('Tolak peminjaman ini?')"
                    class="px-5 py-2 bg-red-600 text-white rounded-lg">
                    Tolak
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
