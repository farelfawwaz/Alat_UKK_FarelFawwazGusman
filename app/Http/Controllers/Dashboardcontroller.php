<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\Peminjaman;

class Dashboardcontroller extends Controller
{
    public function index()
    {
        $totalAlat = Alat::count();

        $alatDipinjam = Alat::where('status', 'dipinjam')->count();
        $alatTersedia = Alat::where('status', 'tersedia')->count();

        $pengajuanBaru = Peminjaman::where('status', 'menunggu')->count();

        $peminjamanTerbaru = Peminjaman::with(['alat', 'user'])
            ->latest()
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalAlat',
            'alatDipinjam',
            'alatTersedia',
            'pengajuanBaru',
            'peminjamanTerbaru'
        ));
    }
}
