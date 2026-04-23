<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori; // WAJIB ADA
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::query();

        // Logika Pencarian
        if ($request->filled('search')) {
            $query->where('nama_buku', 'like', '%' . $request->search . '%');
        }

        // Logika Filter Kategori
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        // Ambil semua kategori untuk navbar menyamping
        $kategoris = Kategori::all(); 
        
        $bukus = $query->get();

        // Kirim $kategoris ke view peminjam.bukus.index
        return view('peminjam.bukus.index', compact('bukus', 'kategoris'));
    }
}