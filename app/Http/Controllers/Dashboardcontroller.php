<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\Peminjaman;

class Dashboardcontroller extends Controller
{
    public function index()
    {
        // jumlah jenis alat
        $totalAlat = Alat::count();

        // total stok yang tersedia
        $totalStokTersedia = Alat::sum('stok');

        // jumlah alat yang sedang dipinjam (AKURAT)
        $alatDipinjam = Peminjaman::where('status', 'dipinjam')->count();

        // jumlah jenis alat yang masih punya stok
        $alatTersedia = Alat::where('stok', '>', 0)->count();

        // pengajuan menunggu
        $pengajuanBaru = Peminjaman::where('status', 'menunggu')->count();

        // peminjaman terbaru
        $peminjamanTerbaru = Peminjaman::with(['alat', 'user'])
            ->latest()
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalAlat',
            'totalStokTersedia',
            'alatDipinjam',
            'alatTersedia',
            'pengajuanBaru',
            'peminjamanTerbaru'
        ));
    }
}
