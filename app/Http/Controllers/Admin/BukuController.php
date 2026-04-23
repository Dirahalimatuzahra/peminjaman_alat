<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori; // Tambahkan ini agar bisa memanggil model Kategori
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::all();
        return view('admin.bukus.index', compact('bukus'));
    }

    // PASTIKAN HANYA ADA SATU FUNGSI CREATE
    public function create()
    {
        // Ambil semua data kategori dari database untuk dikirim ke form
        $kategoris = Kategori::all(); 
        
        // Kirim variabel $kategoris ke file blade
        return view('admin.bukus.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_buku'   => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'stok'        => 'required|integer|min:0',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('storage/bukus'), $nama_file);
            $validated['gambar'] = $nama_file;
        }

        Buku::create($validated);

        return redirect()->route('admin.bukus.index')->with('success', 'Buku berhasil ditambahkan!');
    }
}