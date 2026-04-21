<?php

namespace App\Http\Controllers\Peminjam; // Perhatikan Namespacenya

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        // Mengambil data pinjaman milik user yang sedang login
        $peminjamans = Peminjaman::with('alat')
                        ->where('user_id', auth()->id())
                        ->latest()
                        ->get();

        // Arahkan ke folder peminjam/peminjaman/index
        return view('peminjam.peminjaman.index', compact('peminjamans'));
    }

    public function create(Request $request)
    {
        // Ambil ID Alat dari URL (?alat_id=...)
        $alat_id = $request->query('alat_id');
        
        if (!$alat_id) {
            return redirect()->route('peminjam.alats.index')->with('error', 'Pilih alat dulu.');
        }

        $selected_alat = Alat::findOrFail($alat_id);

        // Langsung panggil view milik peminjam
        return view('peminjam.alats.create', compact('selected_alat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alat_id' => 'required|exists:alats,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $alat = Alat::findOrFail($request->alat_id);

        if ($alat->stok < $request->jumlah) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }

        Peminjaman::create([
        'user_id' => Auth::id(),
        'alat_id' => $request->alat_id,
        'jumlah' => $request->jumlah,
        'tanggal_pinjam' => $request->tanggal_pinjam,
        'tanggal_kembali' => $request->tanggal_kembali,
        'status' => 'pending', // <--- UBAH JADI PENDING
        'petugas_id' => null,   // Biarkan null karena belum dikonfirmasi petugas
        ]);

        $alat->decrement('stok', $request->jumlah);

        return redirect()->route('peminjam.dashboard')->with('success', 'Berhasil meminjam alat!');
    }
}