<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Alat;
use App\Models\User;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ===================== ADMIN =====================
        if ($user->role === 'admin') {

            $totalAlat = Alat::count();

            $totalPeminjam = User::where('role', 'user')->count();

            $alatDipinjam = Peminjaman::where('status', 'disetujui')->count();

            $pengajuanBaru = Peminjaman::where('status', 'menunggu')->count();

            $peminjamanTerbaru = Peminjaman::with('alat')
                ->latest()
                ->take(5)
                ->get();

            $alatTerbatas = Alat::where('stok', '<=', 2)
                ->orderBy('stok')
                ->get();

            return view('dashboard', compact(
                'totalAlat',
                'totalPeminjam',
                'alatDipinjam',
                'pengajuanBaru',
                'peminjamanTerbaru',
                'alatTerbatas'
            ));
        }

        // ===================== PETUGAS =====================
        if ($user->role === 'petugas') {

            $totalStokTersedia = Alat::sum('stok');

            $alatDipinjam = Peminjaman::where('status', 'disetujui')->count();

            $pengajuanBaru = Peminjaman::where('status', 'menunggu')->count();

            $peminjamanTerbaru = Peminjaman::with('alat')
                ->latest()
                ->take(10)
                ->get();

            return view('dashboard', compact(
                'totalStokTersedia',
                'alatDipinjam',
                'pengajuanBaru',
                'peminjamanTerbaru'
            ));
        }

        // ===================== USER =====================
        $userAlatDipinjam = Peminjaman::where('user_id', $user->id)
            ->where('status', 'disetujui')
            ->count();

        $userTotalPeminjaman = Peminjaman::where('user_id', $user->id)
            ->count();

        $userPengajuanMenunggu = Peminjaman::where('user_id', $user->id)
            ->where('status', 'menunggu')
            ->count();

        $userPeminjamanAktif = Peminjaman::with('alat')
            ->where('user_id', $user->id)
            ->where('status', 'disetujui')
            ->latest()
            ->get();

        $userSemuaPeminjaman = Peminjaman::with('alat')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('dashboard', compact(
            'userAlatDipinjam',
            'userTotalPeminjaman',
            'userPengajuanMenunggu',
            'userPeminjamanAktif',
            'userSemuaPeminjaman'
        ));
    }
}
