<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::query();

        // Fitur Pencarian: Mencari di Nama Buku dan Deskripsi
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_buku', 'like', '%' . $searchTerm . '%')
                  ->orWhere('deskripsi', 'like', '%' . $searchTerm . '%');
            });
        }

        // Fitur Filter Kategori
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        // Menampilkan data pendukung
        $kategoris = Kategori::all(); 
        $bukus = $query->get();

        return view('peminjam.bukus.index', compact('bukus', 'kategoris'));
    }

    public function create(Request $request)
    {
        $buku_id = $request->query('buku_id');
        $buku = \App\Models\Buku::findOrFail($buku_id);

        // Tetap arahkan ke view peminjaman agar user bisa mengisi tanggal dll.
        return view('peminjam.peminjaman.create', compact('buku'));
    }
    public function store(Request $request)
{
    $request->validate([
        'judul' => 'required',
        'kategori_id' => 'required',
        'stok' => 'required|integer',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Proses gambar jika ada
    $nama_gambar = null;
    if ($request->hasFile('gambar')) {
        $file = $request->file('gambar');
        $nama_gambar = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('storage/bukus'), $nama_gambar);
    }

    // PAKAI CARA INI: Sebutkan nama kolom database secara manual
        \App\Models\Buku::create([
        'nama_buku'   => $request->judul,      // PAKSA isi nama_buku pakai data judul
        'judul'       => $request->judul,
        'kategori_id' => $request->kategori_id,
        'stok'        => $request->stok,
        'deskripsi'   => $request->deskripsi,
        'gambar'      => $data['gambar'] ?? null,
    ]);

    return redirect()->route('admin.bukus.index')->with('success', 'Buku berhasil disimpan!');
}
}