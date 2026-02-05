<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Alat;
use App\Models\Activitylog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    // ===================== ADMIN INDEX =====================
    public function index(Request $request)
    {
        $query = Peminjaman::with(['alat', 'user']);

        if ($request->search) {
            $query->where('nama_peminjam', 'like', '%' . $request->search . '%');
        }

        $peminjamans = $query->latest()->paginate(10);
        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    // ===================== USER CREATE =====================
    public function create(Alat $alat)
    {
        if ($alat->stok < 1) {
            return redirect()->route('user.alat.index')
                ->with('error', 'Stok alat habis');
        }

        return view('user.peminjaman.create', compact('alat'));
    }

    // ===================== USER STORE (MENUNGGU) =====================
    public function store(Request $request)
    {
        $request->validate([
            'alat_id'        => 'required|exists:alats,id',
            'nama_peminjam'  => 'required|string|max:255',
            'tanggal_pinjam' => 'required|date',
        ]);

        DB::transaction(function () use ($request) {

            $alat = Alat::lockForUpdate()->findOrFail($request->alat_id);

            if ($alat->stok < 1) {
                abort(400, 'Stok alat habis');
            }

            Peminjaman::create([
                'user_id'         => Auth::id(),
                'alat_id'         => $alat->id,
                'nama_peminjam'   => $request->nama_peminjam,
                'no_telp'         => $request->no_telp,
                'alamat'          => $request->alamat,
                'tanggal_pinjam'  => $request->tanggal_pinjam,
                'tanggal_kembali' => null,
                'status'          => 'menunggu',
            ]);

            Activitylog::create([
                'user_id'   => Auth::id(),
                'aksi'      => 'ajukan',
                'modul'     => 'peminjaman',
                'deskripsi' => 'Mengajukan peminjaman alat: ' . $alat->nama_alat,
            ]);
        });

        return redirect()->route('user.peminjaman.index')
            ->with('success', 'Pengajuan berhasil, menunggu persetujuan petugas');
    }

    // ===================== PETUGAS SETUJUI =====================
    public function setujui(Peminjaman $peminjaman)
    {
        DB::transaction(function () use ($peminjaman) {

            if ($peminjaman->status !== 'menunggu') {
                abort(400, 'Peminjaman sudah diproses');
            }

            $alat = Alat::lockForUpdate()->findOrFail($peminjaman->alat_id);

            if ($alat->stok < 1) {
                abort(400, 'Stok alat habis');
            }

            $alat->decrement('stok');

            $peminjaman->update([
                'status' => 'dipinjam',
            ]);

            Activitylog::create([
                'user_id'   => Auth::id(),
                'aksi'      => 'setujui',
                'modul'     => 'peminjaman',
                'deskripsi' => 'Menyetujui peminjaman alat: ' . $alat->nama_alat,
            ]);
        });

        return back()->with('success', 'Peminjaman berhasil disetujui');
    }

    // ===================== PENGEMBALIAN =====================
    public function kembalikan(Peminjaman $peminjaman)
    {
        // JIKA USER → CEK PEMILIK
        if (Auth::user()->role === 'user') {
            if ($peminjaman->user_id !== Auth::id()) {
                abort(403);
            }
        }

        if ($peminjaman->status !== 'dipinjam') {
            return back()->with('error', 'Peminjaman tidak aktif');
        }

        DB::transaction(function () use ($peminjaman) {

            $peminjaman->alat->increment('stok');

            $peminjaman->update([
                'status' => 'dikembalikan',
                'tanggal_kembali' => now(),
            ]);

            Activitylog::create([
                'user_id'   => Auth::id(),
                'aksi'      => 'kembalikan',
                'modul'     => 'peminjaman',
                'deskripsi' => 'Mengembalikan alat: ' . $peminjaman->alat->nama_alat,
            ]);
        });

        return back()->with('success', 'Alat berhasil dikembalikan');
    }



    // ===================== USER INDEX =====================
    public function userIndex()
    {
        $peminjamans = Peminjaman::with('alat')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('user.peminjaman.index', compact('peminjamans'));
    }

    // ===================== USER PENGEMBALIAN =====================
    public function userPengembalian()
    {
        $peminjamans = Peminjaman::with('alat')
            ->where('user_id', Auth::id())
            ->where('status', 'dipinjam') // HANYA YANG AKTIF
            ->latest()
            ->paginate(10);

        return view('user.pengembalian.index', compact('peminjamans'));
    }
}
