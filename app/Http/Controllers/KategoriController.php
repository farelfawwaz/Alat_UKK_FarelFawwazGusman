<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Activitylog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::latest()->paginate(10);
        return view('admin.kategori.index', compact('kategori'));
    }

    public function create() // ⬅️ WAJIB ADA
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255'
        ]);

        // simpan kategori
        $kategori = Kategori::create([
            'name'      => $request->name,
            'deskripsi' => $request->deskripsi,
            'slug'      => Str::slug($request->name)
        ]);

        // simpan activity log
        Activitylog::create([
            'user_id'   => Auth::id(), // pastikan sudah login
            'aksi'      => 'tambah',
            'modul'     => 'kategori',
            'deskripsi' => 'Menambahkan kategori: ' . $kategori->name,
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $kategori->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori diperbarui');
    }

    public function destroy(Kategori $kategori)
    {

        // simpan activity log
        Activitylog::create([
            'user_id'   => Auth::id(), // pastikan sudah login
            'aksi'      => 'hapus',
            'modul'     => 'kategori',
            'deskripsi' => 'Menghapus kategori: ' . $kategori->name,
        ]);
        $kategori->delete();

        return redirect()->back()
            ->with('success', 'Kategori dihapus');
    }
}
