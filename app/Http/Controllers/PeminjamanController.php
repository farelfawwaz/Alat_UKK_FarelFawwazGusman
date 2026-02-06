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
    // ===================== ADMIN =====================
    public function index(Request $request)
    {
        $query = Peminjaman::with(['alat', 'user']);

        if ($request->search) {
            $query->where('nama_peminjam', 'like', '%' . $request->search . '%');
        }

        $peminjamans = $query->latest()->paginate(10);
        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    // ===================== USER =====================
    public function create(Alat $alat)
    {
        if ($alat->stok < 1) {
            return redirect()->route('user.alat.index')
                ->with('error', 'Stok alat habis');
        }

        return view('user.peminjaman.create', compact('alat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alat_id'        => 'required|exists:alats,id',
            'nama_peminjam'  => 'required|string|max:255',
            'tanggal_pinjam' => 'required|date',
        ]);

        DB::transaction(function () use ($request) {
            $alat = Alat::lockForUpdate()->findOrFail($request->alat_id);

            if ($alat->stok < 1) abort(400, 'Stok alat habis');

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
                'deskripsi' => 'Mengajukan peminjaman alat: ' . $alat->nama,
            ]);
        });

        return redirect()->route('user.peminjaman.index')
            ->with('success', 'Pengajuan berhasil, menunggu persetujuan petugas');
    }

    public function userIndex()
    {
        $peminjamans = Peminjaman::with('alat')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('user.peminjaman.index', compact('peminjamans'));
    }

    public function userPengembalian()
    {
        $peminjamans = Peminjaman::with('alat')
            ->where('user_id', Auth::id())
            ->where('status', 'disetujui')
            ->latest()
            ->paginate(10);

        return view('user.pengembalian.index', compact('peminjamans'));
    }

    // ===================== PETUGAS =====================
    public function indexPetugas()
    {
        $peminjaman = Peminjaman::with(['alat', 'user'])
            ->where('status', 'menunggu')
            ->latest()
            ->get();

        return view('petugas.peminjaman.index', compact('peminjaman'));
    }

    public function show(Peminjaman $peminjaman)
    {
        return view('petugas.peminjaman.show', compact('peminjaman'));
    }

    public function persetujuan()
    {
        $peminjaman = Peminjaman::with(['user', 'alat'])
            ->where('status', 'menunggu')
            ->get();

        return view('petugas.peminjaman.index', compact('peminjaman'));
    }

    public function setujui(Peminjaman $peminjaman)
    {
        DB::transaction(function () use ($peminjaman) {
            if ($peminjaman->status !== 'menunggu') abort(400, 'Peminjaman sudah diproses');

            $alat = Alat::lockForUpdate()->findOrFail($peminjaman->alat_id);

            if ($alat->stok < 1) abort(400, 'Stok alat habis');

            $alat->decrement('stok');

            $peminjaman->update(['status' => 'disetujui']);

            Activitylog::create([
                'user_id'   => Auth::id(),
                'aksi'      => 'setujui',
                'modul'     => 'peminjaman',
                'deskripsi' => 'Menyetujui peminjaman alat: ' . $alat->nama,
            ]);
        });

        return back()->with('success', 'Peminjaman berhasil disetujui');
    }

    public function tolak(Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'menunggu') abort(400, 'Peminjaman sudah diproses');

        $peminjaman->update(['status' => 'ditolak']);

        Activitylog::create([
            'user_id'   => Auth::id(),
            'aksi'      => 'tolak',
            'modul'     => 'peminjaman',
            'deskripsi' => 'Menolak peminjaman alat: ' . $peminjaman->alat->nama,
        ]);

        return back()->with('success', 'Peminjaman berhasil ditolak');
    }

    // ===================== PETUGAS MONITORING PENGEMBALIAN =====================
    public function monitoringPengembalian(Request $request)
    {
        $query = Peminjaman::with(['user', 'alat'])
            ->where('status', 'dikembalikan');

        if ($request->from && $request->to) {
            $query->whereBetween('tanggal_kembali', [
                $request->from,
                $request->to
            ]);
        }

        $peminjamans = $query
            ->latest('tanggal_kembali')
            ->paginate(10)
            ->withQueryString();

        return view('petugas.pengembalian.index', compact('peminjamans'));
    }



    // ===================== PENGEMBALIAN (USER & PETUGAS) =====================
    public function kembalikan(Peminjaman $peminjaman)
    {
        if (Auth::user()->role === 'user' && $peminjaman->user_id !== Auth::id()) {
            abort(403);
        }

        if ($peminjaman->status !== 'disetujui') {
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
                'deskripsi' => 'Mengembalikan alat: ' . $peminjaman->alat->nama,
            ]);
        });

        return redirect()
            ->route('user.pengembalian.index')
            ->with('success', 'Alat berhasil dikembalikan');
    }
}
