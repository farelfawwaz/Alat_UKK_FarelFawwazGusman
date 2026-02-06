<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function peminjaman(Request $request)
    {
        $query = Peminjaman::with(['user', 'alat']);

        if ($request->filled('dari') && $request->filled('sampai')) {
            $query->whereBetween('tanggal_pinjam', [
                $request->dari,
                $request->sampai
            ]);
        }

        $laporan = $query->orderBy('tanggal_pinjam', 'desc')->get();

        return view('petugas.laporan.index', compact('laporan'));
    }
}

