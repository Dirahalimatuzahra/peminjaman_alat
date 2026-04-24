<?php

namespace App\Http\Controllers\Admin; // PASTIKAN INI ADMIN

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        // Admin melihat semua transaksi
        $peminjaman = Peminjaman::with(['user', 'buku'])->latest()->get();
        return view('admin.peminjaman.index', compact('peminjaman'));
    }

    public function update(Request $request, $id)
    {
        $p = Peminjaman::findOrFail($id);
        
        // Logika sederhana untuk Admin mengubah status
        $p->update(['status' => $request->status]);

        return back()->with('success', 'Status berhasil diubah!');
    }
}