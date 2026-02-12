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
                'user_id' => auth::id(),
                'alat_id' => $alat->id,
                'nama_peminjam' => $request->nama_peminjam,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_kembali' => $request->tanggal_kembali,
                'jumlah' => $request->jumlah,
                'status' => 'menunggu',
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

    public function setujui($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $alat = Alat::findOrFail($peminjaman->alat_id);

        // 🔒 Jangan proses kalau sudah diproses
        if ($peminjaman->status !== 'menunggu') {
            return back()->with('error', 'Peminjaman sudah diproses.');
        }

        // ❗ Cek stok cukup atau tidak
        if ($peminjaman->jumlah > $alat->stok) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        // ✅ Kurangi stok sesuai jumlah
        $alat->stok -= $peminjaman->jumlah;
        $alat->save();

        // ✅ Update status
        $peminjaman->status = 'disetujui';
        $peminjaman->save();

        return back()->with('success', 'Peminjaman disetujui.');
    }


    public function tolak(Request $request, $id)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string|max:500'
        ]);

        $peminjaman = Peminjaman::findOrFail($id);

        // 🔒 Jangan proses kalau sudah diproses
        if ($peminjaman->status !== 'menunggu') {
            return back()->with('error', 'Peminjaman sudah diproses.');
        }

        $peminjaman->update([
            'status' => 'ditolak',
            'alasan_penolakan' => $request->alasan_penolakan
        ]);

        return back()->with('success', 'Peminjaman ditolak.');
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
    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $alat = Alat::findOrFail($peminjaman->alat_id);

        if ($peminjaman->status !== 'disetujui') {
            return back()->with('error', 'Status tidak valid.');
        }

        // ✅ Tambahkan kembali stok
        $alat->stok += $peminjaman->jumlah;
        $alat->save();

        $peminjaman->status = 'dikembalikan';
        $peminjaman->save();

        return back()->with('success', 'Alat berhasil dikembalikan.');
    }
}
