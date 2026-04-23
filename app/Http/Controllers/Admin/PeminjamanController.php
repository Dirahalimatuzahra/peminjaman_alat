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

    // Ubah nama menjadi 'update' agar sesuai dengan route default atau yang Anda panggil di Blade
    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        if ($request->status == 'disetujui') {
            $peminjaman->status = 'disetujui';
            // Stok biasanya dikurangi saat pengajuan disetujui jika belum dikurangi di awal
            $peminjaman->buku->decrement('stok', $peminjaman->jumlah); 
            $peminjaman->save();
            return back()->with('success', 'Peminjaman telah disetujui.');
        } elseif ($request->status == 'ditolak') {
            $peminjaman->status = 'ditolak';
            $peminjaman->save();
            return back()->with('success', 'Peminjaman telah ditolak.');
        }

        return back();
    }

    // Tambahkan fungsi destroy untuk menghapus data
    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // Jika data yang dihapus masih berstatus 'disetujui' atau 'pending', 
        // kembalikan stok buku sebelum dihapus
        if ($peminjaman->status == 'disetujui' || $peminjaman->status == 'pending') {
            $peminjaman->buku->increment('stok', $peminjaman->jumlah);
        }

        $peminjaman->delete();

        return redirect()->back()->with('success', 'Data peminjaman berhasil dihapus.');
    }
}