<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data ringkas untuk dashboard peminjam
        // Menghitung hanya data milik user yang sedang login
        $totalPinjam = Peminjaman::where('user_id', Auth::id())->count();
        
        $sedangDipinjam = Peminjaman::where('user_id', Auth::id())
            ->where('status', 'dipinjam')
            ->count();

        // Data tambahan untuk informasi alat yang tersedia di sekolah
        $alatTersedia = Alat::where('stok', '>', 0)->count();

        return view('peminjam.dashboard', compact(
            'totalPinjam', 
            'sedangDipinjam', 
            'alatTersedia'
        ));
    }
}