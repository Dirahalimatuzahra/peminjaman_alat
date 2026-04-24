<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    public function store(Request $request, $id)
    {
        $peminjaman = Peminjaman::with('buku')->findOrFail($id);

        // Update status jadi dikembalikan
        $peminjaman->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => now()
        ]);

        // TAMBAH STOK KEMBALI
        if ($peminjaman->buku) {
            $peminjaman->buku->increment('stok', $peminjaman->jumlah);
        }

        return back()->with('success', 'Buku telah diterima kembali dan stok bertambah.');
    }
}