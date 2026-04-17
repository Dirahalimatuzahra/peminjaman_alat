<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Menampilkan daftar peminjaman
     */
    public function index()
    {
        // Mengambil data peminjaman beserta relasi user dan alat
        $peminjamans = Peminjaman::with(['user', 'alat'])->latest()->get();
        return view('admin.peminjamans.index', compact('peminjamans'));
    }

    /**
     * Menampilkan form tambah peminjaman
     */
    public function create()
    {
        // Mengambil user yang rolenya 'peminjam' dan semua data alat
        $users = User::where('role', 'peminjam')->get();
        $alats = Alat::all();
        return view('admin.peminjamans.create', compact('users', 'alats'));
    }

    /**
     * Menyimpan data peminjaman baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'alat_id' => 'required|exists:alats,id',
            'tanggal_pinjam' => 'required|date',
        ]);

        Peminjaman::create([
            'user_id' => $request->user_id,
            'alat_id' => $request->alat_id,
            'petugas_id' => Auth::id(), // Mengambil ID admin/petugas yang sedang login
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'status' => 'dipinjam',
        ]);

        return redirect()->route('admin.peminjamans.index')->with('success', 'Peminjaman berhasil dicatat!');
    }

    /**
     * Menghapus data peminjaman
     */
    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();
        return redirect()->route('admin.peminjamans.index')->with('success', 'Data peminjaman berhasil dihapus!');
    }

    // Fungsi show, edit, dan update bisa ditambahkan nanti jika diperlukan
}
