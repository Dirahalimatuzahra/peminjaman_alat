<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Alat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Menampilkan form peminjaman baru
     */
    public function create(Request $request)
    {
        // 1. Ambil ID Alat dari parameter URL
        $alat_id = $request->query('alat_id');
        
        // Jika ID tidak ada, jangan lempar ke dashboard, tapi beri pesan error
        if (!$alat_id) {
            return redirect()->back()->with('error', 'Silakan pilih alat terlebih dahulu melalui menu Cari Alat.');
        }

        $selected_alat = Alat::findOrFail($alat_id);

        if (Auth::user()->role === 'peminjam') {
            // 2. Langsung arahkan ke file create.blade.php di folder peminjam
            return view('peminjam.create', compact('selected_alat'));
        }

        $users = User::all();
        $alats = Alat::where('stok', '>', 0)->get();
        return view('admin.peminjamans.create', compact('users', 'alats', 'selected_alat'));
    }

    /**
     * Menampilkan daftar peminjaman (Riwayat)
     */
    public function index()
    {
        if (Auth::user()->role === 'peminjam') {
            // Karena Anda BELUM punya file peminjam/index.blade.php
            // Maka sementara dilempar ke dashboard.
            return redirect()->route('peminjam.dashboard')
                             ->with('info', 'Halaman Riwayat Pinjam belum tersedia.');
        } 

        $peminjamans = Peminjaman::with(['user', 'alat'])->latest()->get();
        return view('admin.peminjamans.index', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role === 'peminjam') {
            $request->merge(['user_id' => Auth::id()]);
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'alat_id' => 'required|exists:alats,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $alat = Alat::findOrFail($request->alat_id);

        if ($alat->stok < $request->jumlah) {
            return back()->with('error', 'Maaf, stok alat tidak mencukupi!');
        }

        Peminjaman::create([
            'user_id' => $request->user_id,
            'alat_id' => $request->alat_id,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'dipinjam',
        ]);

        $alat->decrement('stok', $request->jumlah);

        // Jika berhasil simpan, baru boleh ke dashboard
        return redirect()->route('peminjam.dashboard')->with('success', 'Peminjaman berhasil!');
    }
}