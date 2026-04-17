<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Alat;
use App\Models\User;
use Illuminate\Http\Request;

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
     * Menampilkan form peminjaman baru
     */
    public function create()
    {
        // Menyaring hanya user dengan role siswa (mengantisipasi huruf besar/kecil)
        // Agar Admin dan Petugas tidak muncul di dropdown
        $users = User::all();

        // Jika variabel $users kosong, pastikan ada data siswa di tabel users kamu
        if ($users->isEmpty()) {
            // Opsional: ambil semua user jika filter 'siswa' tidak menemukan hasil
            // $users = User::all(); 
        }

        // Hanya mengambil alat yang stoknya lebih dari 0
        $alats = Alat::where('stok', '>', 0)->get();

        return view('admin.peminjamans.create', compact('users', 'alats'));
    }

    /**
     * Menyimpan data peminjaman ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'alat_id' => 'required|exists:alats,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
        ]);

        $alat = Alat::findOrFail($request->alat_id);

        // Validasi ketersediaan stok
        if ($alat->stok < $request->jumlah) {
            return back()->with('error', 'Maaf, stok alat tidak mencukupi!');
        }

        // Simpan data peminjaman
        Peminjaman::create([
            'user_id' => $request->user_id,
            'alat_id' => $request->alat_id,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'status' => 'dipinjam', // Status default saat meminjam
        ]);

        // Kurangi stok alat secara otomatis
        $alat->decrement('stok', $request->jumlah);

        return redirect()->route('admin.peminjamans.index')
                         ->with('success', 'Data peminjaman berhasil disimpan dan stok alat diperbarui!');
    }

    /**
     * Menghapus data peminjaman
     */
    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // Jika data dihapus saat status masih 'dipinjam', kembalikan stok alatnya
        if ($peminjaman->status == 'dipinjam') {
            $peminjaman->alat->increment('stok', $peminjaman->jumlah);
        }

        $peminjaman->delete();

        return redirect()->route('admin.peminjamans.index')
                         ->with('success', 'Data peminjaman berhasil dihapus!');
    }
}