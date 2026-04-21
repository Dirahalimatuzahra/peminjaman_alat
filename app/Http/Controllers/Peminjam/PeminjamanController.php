<?php

namespace App\Http\Controllers\Peminjam; // Pastikan namespace-nya Peminjam

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Menampilkan form pinjam (Halaman yang tadinya error/ke lempar)
     */
    public function create(Request $request)
    {
        $alat_id = $request->query('alat_id');
        
        // Cari alat berdasarkan ID yang dikirim dari tombol "Pinjam Alat"
        $selected_alat = Alat::findOrFail($alat_id);

        // Langsung panggil view di folder peminjam
        return view('peminjam.create', compact('selected_alat'));
    }

    /**
     * Proses simpan data peminjaman
     */
    public function store(Request $request)
    {
        $request->validate([
            'alat_id' => 'required|exists:alats,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $alat = Alat::findOrFail($request->alat_id);

        // Validasi stok
        if ($alat->stok < $request->jumlah) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }

        // Simpan data
        Peminjaman::create([
            'user_id' => Auth::id(), // Otomatis pakai ID user yang login (Nunung)
            'alat_id' => $request->alat_id,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'dipinjam',
        ]);

        // Kurangi stok alat
        $alat->decrement('stok', $request->jumlah);

        return redirect()->route('peminjam.dashboard')->with('success', 'Peminjaman berhasil diajukan!');
    }
}