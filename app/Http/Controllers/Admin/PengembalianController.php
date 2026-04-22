<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    /**
     * Menampilkan daftar peminjaman yang siap dikembalikan.
     */
    public function index()
    {
        // Hanya menampilkan buku yang statusnya masih 'dipinjam'
        $pengembalians = Peminjaman::with(['user', 'buku'])
            ->where('status', 'dipinjam')
            ->latest()
            ->get();

        return view('admin.pengembalians.index', compact('pengembalians'));
    }

    /**
     * Fungsi untuk konfirmasi pengembalian buku secara cepat.
     */
    public function konfirmasi(Request $request)
    {
        // Validasi input peminjaman_id agar tidak error
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjamans,id',
        ]);

        $peminjaman = Peminjaman::findOrFail($request->peminjaman_id);

        $peminjaman->update([
            'tanggal_kembali' => Carbon::now(),
            'status' => 'kembali'
        ]);

        // Mengembalikan stok buku secara otomatis
        $peminjaman->buku->increment('stok');

        return redirect()->route('admin.pengembalians.index')
            ->with('success', 'Buku telah berhasil dikembalikan!');
    }

    /**
     * Menampilkan form edit data pengembalian.
     */
    public function edit(string $id)
    {
        $pengembalian = Peminjaman::findOrFail($id);
        return view('admin.pengembalians.edit', compact('pengembalian'));
    }

    /**
     * Memperbarui data pengembalian secara manual.
     */
    public function update(Request $request, string $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        // Gunakan update dengan aman
        $peminjaman->update($request->all());

        return redirect()->route('admin.pengembalians.index')
            ->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Menghapus data riwayat pengembalian.
     */
    public function destroy(string $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();

        return redirect()->route('admin.pengembalians.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}