<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\User;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        // Admin melihat semua data peminjaman
        $peminjamans = Peminjaman::with(['user', 'buku'])->latest()->get();
        return view('admin.peminjamans.index', compact('peminjamans'));
    }

    public function create(Request $request)
    {
        $users = User::all();
        $bukus = Buku::where('stok', '>', 0)->get();
        $buku_id = $request->query('buku_id');
        $selected_buku = $buku_id ? Buku::find($buku_id) : null;

        return view('admin.peminjamans.create', compact('users', 'bukus', 'selected_buku'));
    }

    public function updateStatus(Request $request, $id)
{
    $peminjaman = Peminjaman::findOrFail($id);
    
    // Logika untuk mengubah status
    if ($request->status == 'dipinjam') {
        $peminjaman->status = 'dipinjam';
        $peminjaman->save();
        return back()->with('success', 'Peminjaman telah disetujui.');
    } elseif ($request->status == 'ditolak') {
        // Jika ditolak, kembalikan stok buku yang sebelumnya berkurang
        $peminjaman->buku->increment('stok', $peminjaman->jumlah);
        $peminjaman->status = 'ditolak';
        $peminjaman->save();
        return back()->with('success', 'Peminjaman telah ditolak.');
    }

    return back();
}
    // Logika store admin tetap ada jika admin ingin menginputkan pinjaman untuk siswa
}