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
        // Hanya menampilkan alat yang statusnya masih 'dipinjam'
        $pengembalians = Peminjaman::with(['user', 'alat'])
            ->where('status', 'dipinjam')
            ->latest()
            ->get();

        return view('admin.pengembalians.index', compact('pengembalians'));
    }

    /**
     * Fungsi untuk konfirmasi pengembalian alat secara cepat.
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

        // Mengembalikan stok alat secara otomatis
        $peminjaman->alat->increment('stok');

        return redirect()->route('admin.pengembalians.index')
            ->with('success', 'Alat telah berhasil dikembalikan!');
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