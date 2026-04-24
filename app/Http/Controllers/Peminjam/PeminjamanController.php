<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with('buku')
                        ->where('user_id', auth()->id())
                        ->latest()
                        ->get();

        return view('peminjam.peminjaman.index', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok < $request->jumlah) {
            return back()->with('error', 'Stok buku tidak mencukupi!');
        }

        Peminjaman::create([
            'user_id' => auth()->id(),
            'buku_id' => $request->buku_id,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => now(),
            'tanggal_kembali' => now()->addDays(7),
            'status' => 'pending',
        ]);

        // Perbaikan: sesuaikan dengan nama route di web.php kamu (peminjam.peminjaman.index)
        return redirect()->route('peminjam.peminjaman.index')->with('success', 'Pengajuan dikirim!');
    }
}