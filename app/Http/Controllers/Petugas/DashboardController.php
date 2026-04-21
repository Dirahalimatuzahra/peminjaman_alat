<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Alat;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard utama untuk Petugas.
     * * @return \Illuminate\View\View
     */
    public function index()
    {
        // 1. Menghitung jumlah peminjaman yang statusnya masih 'pending'
        // Ini digunakan untuk memberi tahu petugas ada berapa pengajuan yang perlu dikonfirmasi.
        $count_pending = Peminjaman::where('status', 'pending')->count();

        // 2. Menghitung jumlah peminjaman yang statusnya 'dipinjam'
        // Digunakan untuk memantau berapa banyak barang yang sedang berada di luar/dibawa siswa.
        $count_dipinjam = Peminjaman::where('status', 'dipinjam')->count();

        // 3. Menghitung total stok alat yang tersedia di gudang/sekolah
        // Menggunakan fungsi sum() untuk menjumlahkan semua angka di kolom 'stok' pada tabel alats.
        $count_alat = Alat::sum('stok');

        // Mengirimkan semua data yang dihitung ke view 'petugas.dashboard'
        return view('petugas.dashboard', compact(
            'count_pending', 
            'count_dipinjam', 
            'count_alat'
        ));
    }
}