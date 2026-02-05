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
    public function index(Request $request)
    {
        $query = Peminjaman::with('alat');

        if ($request->search) {
            $query->where('nama_peminjam', 'like', '%' . $request->search . '%');
        }

        $peminjamans = $query->latest()->paginate(10);
        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    public function create()
    {
        $alats = Alat::where('stok', '>', 0)->get();
        return view('admin.peminjaman.create', compact('alats'));
    }

    // ===================== STORE =====================
    public function store(Request $request)
    {
        $request->validate([
            'alat_id'        => 'required|exists:alats,id',
            'nama_peminjam'  => 'required|string',
            'tanggal_pinjam' => 'required|date',
        ]);

        DB::transaction(function () use ($request) {

            $alat = Alat::where('id', $request->alat_id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($alat->stok < 1) {
                abort(400, 'Stok alat habis');
            }

            // ✅ SIMPAN KE VARIABEL
            $peminjaman = Peminjaman::create([
                'user_id'        => Auth::id(),
                'alat_id'        => $alat->id,
                'nama_peminjam'  => $request->nama_peminjam,
                'no_telp'        => $request->no_telp,
                'alamat'         => $request->alamat,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_kembali'=> null,
                'status'         => 'dipinjam',
            ]);

            // ➖ Kurangi stok
            $alat->decrement('stok');

            // 📝 Activity Log
            Activitylog::create([
                'user_id'   => Auth::id(),
                'aksi'      => 'pinjam',
                'modul'     => 'peminjaman',
                'deskripsi' => 'Meminjam alat: ' . $alat->nama_alat,
            ]);
        });

        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Data peminjaman berhasil ditambahkan');
    }

    // ===================== KEMBALIKAN =====================
    public function kembalikan(Peminjaman $peminjaman)
    {
        DB::transaction(function () use ($peminjaman) {

            if ($peminjaman->status === 'dipinjam') {

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
            }
        });

        return back()->with('success', 'Alat berhasil dikembalikan');
    }

    // ===================== PENGEMBALIAN =====================
    public function pengembalian()
    {
        $peminjaman = Peminjaman::with(['user', 'alat'])
            ->where('status', 'dipinjam')
            ->latest('tanggal_kembali')
            ->get();

        return view('admin.pengembalian.index', compact('peminjaman'));
    }
}
