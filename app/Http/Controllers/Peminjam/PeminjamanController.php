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
        // Ambil ID Buku dari URL (?buku_id=...)
        $buku_id = $request->query('buku_id');
        
        if (!$buku_id) {
            return redirect()->route('peminjam.bukus.index')->with('error', 'Pilih buku dulu.');
        }

        $selected_buku = Buku::findOrFail($buku_id);

        // Langsung panggil view milik peminjam
        return view('peminjam.bukus.create', compact('selected_buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok < $request->jumlah) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }

        Peminjaman::create([
        'user_id' => Auth::id(),
        'buku_id' => $request->buku_id,
        'jumlah' => $request->jumlah,
        'tanggal_pinjam' => $request->tanggal_pinjam,
        'tanggal_kembali' => $request->tanggal_kembali,
        'status' => 'pending', // <--- UBAH JADI PENDING
        'petugas_id' => null,   // Biarkan null karena belum dikonfirmasi petugas
        ]);

        $buku->decrement('stok', $request->jumlah);

        return redirect()->route('peminjam.dashboard')->with('success', 'Berhasil meminjam buku!');
    }
}