<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;

class Alatcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $alats = Alat::latest()->paginate(10);
        return view('alat.index', compact('alats'));
    }

    public function create()
    {
        return view('alat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required',
            'kode_alat' => 'required|unique:alats',
            'kategori'  => 'required',
            'stok'      => 'required|integer'
        ]);

        Alat::create($request->all());

        return redirect()->route('alat.index')->with('success', 'Alat berhasil ditambahkan');
    }

    public function edit(Alat $alat)
    {
        return view('alat.edit', compact('alat'));
    }

    public function update(Request $request, Alat $alat)
    {
        $request->validate([
            'nama_alat' => 'required',
            'kategori'  => 'required',
            'stok'      => 'required|integer'
        ]);

        $alat->update($request->all());

        return redirect()->route('alat.index')->with('success', 'Alat berhasil diperbarui');
    }

    public function destroy(Alat $alat)
    {
        $alat->delete();
        return back()->with('success', 'Alat berhasil dihapus');
    }
}
