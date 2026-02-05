<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\Kategori;
use App\Models\Activitylog;
use Illuminate\Support\Facades\Auth;

class AlatController extends Controller
{
    /* ================= ADMIN ================= */

    public function index()
    {
        $alats = Alat::with('kategori')->latest()->paginate(10);
        return view('admin.alat.index', compact('alats'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.alat.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required',
            'kode_alat' => 'required',
            'kategori_id' => 'required',
            'stok' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('alat', 'public');
        }

       $alat = Alat::create([
            'nama_alat' => $request->nama_alat,
            'kode_alat' => $request->kode_alat,
            'kategori_id' => $request->kategori_id,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'image' => $imagePath,
        ]);

        Activitylog::create([
            'user_id'   => Auth::id(),
            'aksi'      => 'tambah',
            'modul'     => 'alat',
            'deskripsi' => 'Menambahkan alat: ' . $alat->nama_alat,
        ]);

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil ditambahkan');
    }

    public function edit(Alat $alat)
    {
        $kategori = Kategori::all();
        return view('admin.alat.edit', compact('alat', 'kategori'));
    }

    public function update(Request $request, Alat $alat)
    {
 $request->validate([
        'nama_alat' => 'required',
        'kategori_id' => 'required',
        'stok' => 'required|integer',
        'status' => 'required',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('alat', 'public');
            $alat->image = $imagePath;
        }

        $alat->update([
            'nama_alat'   => $request->nama_alat,
            'kategori_id' => $request->kategori_id,
            'stok'        => $request->stok,
            'deskripsi'   => $request->deskripsi,
        ]);

        Activitylog::create([
            'user_id'   => Auth::id(),
            'aksi'      => 'update',
            'modul'     => 'alat',
            'deskripsi' => 'Update alat: ' . $alat->nama_alat,
        ]);

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil diperbarui');
    }

    public function destroy(Alat $alat)
    {
        Activitylog::create([
            'user_id'   => Auth::id(),
            'aksi'      => 'hapus',
            'modul'     => 'alat',
            'deskripsi' => 'Menghapus alat: ' . $alat->nama_alat,
        ]);

        $alat->delete();

        return back()->with('success', 'Alat berhasil dihapus');
    }

    /* ================= USER ================= */

    public function userIndex(Request $request)
    {
        $alats = Alat::with('kategori')
            ->when($request->search, function ($q) use ($request) {
                $q->where('nama_alat', 'like', '%' . $request->search . '%');
            })
            ->where('stok', '>', 0)
            ->latest()
            ->paginate(9);

        return view('user.alat.index', compact('alats'));
    }
}
