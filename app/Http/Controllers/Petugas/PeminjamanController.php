<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Alat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    /**
     * Menampilkan daftar semua peminjaman (Admin/Petugas)
     */
    public function index()
    {
        // Mengambil semua data peminjaman beserta relasi user dan alat
        $peminjamans = Peminjaman::with(['user', 'alat'])->latest()->get();
        
        return view('admin.peminjamans.index', compact('peminjamans'));
    }

    /**
     * Menampilkan form untuk admin jika ingin menginputkan pinjaman secara manual
     */
    public function create()
    {
        $users = User::where('role', 'peminjam')->get();
        $alats = Alat::where('stok', '>', 0)->get();
        
        return view('admin.peminjamans.create', compact('users', 'alats'));
    }

    /**
     * Logika untuk Konfirmasi Peminjaman (Dari Pending ke Dipinjam)
     */
    public function konfirmasi(Request $request, $id)
    {
        // Menggunakan Database Transaction agar data konsisten
        DB::beginTransaction();

        try {
            $peminjaman = Peminjaman::findOrFail($id);
            $alat = Alat::findOrFail($peminjaman->alat_id);

            // 1. Cek apakah status memang masih pending
            if ($peminjaman->status !== 'pending') {
                return back()->with('error', 'Status peminjaman ini sudah diproses sebelumnya.');
            }

            // 2. Cek apakah stok alat mencukupi saat disetujui
            if ($alat->stok < $peminjaman->jumlah) {
                return back()->with('error', 'Stok alat tidak mencukupi untuk disetujui.');
            }

            // 3. Update status peminjaman
            $peminjaman->update([
                'status' => 'dipinjam',
                'petugas_id' => auth()->id(), // Mencatat admin/petugas yang menyetujui
            ]);

            // 4. Kurangi stok alat secara otomatis
            $alat->decrement('stok', $peminjaman->jumlah);

            DB::commit();
            return back()->with('success', 'Peminjaman berhasil disetujui dan stok alat telah dikurangi.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    /**
     * Menolak Peminjaman
     */
    public function tolak($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        $peminjaman->update([
            'status' => 'ditolak',
            'petugas_id' => auth()->id()
        ]);

        return back()->with('success', 'Peminjaman telah ditolak.');
    }

    /**
     * Menghapus data riwayat (opsional)
     */
    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();

        return back()->with('success', 'Data peminjaman berhasil dihapus.');
    }
}