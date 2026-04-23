<?php

namespace App\Http\Controllers\Peminjam; // Perhatikan Namespacenya

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        // Mengambil data pinjaman milik user yang sedang login
        $peminjamans = Peminjaman::with('buku')
                        ->where('user_id', auth()->id())
                        ->latest()
                        ->get();

        // Arahkan ke folder peminjam/peminjaman/index
        return view('peminjam.peminjaman.index', compact('peminjamans'));
    }

    public function create(Request $request)
    {
        // Mengambil id dari query string: /peminjaman/create?buku_id=1
        $buku_id = $request->query('buku_id');
        
        if (!$buku_id) {
            return redirect()->route('peminjam.bukus.index')->with('error', 'Pilih buku dulu.');
        }

        // Gunakan nama variabel $buku agar sesuai dengan file Blade Anda
        $buku = Buku::findOrFail($buku_id);

        return view('peminjam.peminjaman.create', compact('buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
            'keterangan' => 'required|string|min:5', // Alasan meminjam
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok < $request->jumlah) {
            return back()->with('error', 'Stok buku tidak mencukupi!');
        }

        Peminjaman::create([
            'user_id' => auth()->id(),
            'buku_id' => $request->buku_id,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'keterangan' => $request->keterangan,
            'status' => 'pending',
        ]);

        // Opsional: stok dikurangi setelah admin setuju, 
        // tapi kalau mau dikurangi sekarang pakai: $buku->decrement('stok', $request->jumlah);

        return redirect()->route('peminjam.bukus.index')->with('success', 'Pengajuan peminjaman berhasil dikirim!');
    }
}