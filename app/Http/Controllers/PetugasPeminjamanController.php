<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetugasPeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with(['user', 'alat'])
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('petugas.peminjaman.index', compact('peminjaman'));
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with(['user', 'alat'])->findOrFail($id);
        return view('petugas.peminjaman.show', compact('peminjaman'));
    }

    public function approve($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'status' => 'approved',
            'approved_by' => auth::id(),
            'approved_at' => now(),
        ]);

        return redirect()
            ->route('petugas.peminjaman.index')
            ->with('success', 'Peminjaman berhasil disetujui');
    }

    public function reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'status' => 'rejected',
        ]);

        return redirect()
            ->route('petugas.peminjaman.index')
            ->with('success', 'Peminjaman ditolak');
    }
}
