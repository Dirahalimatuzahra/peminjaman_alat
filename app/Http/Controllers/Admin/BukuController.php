<?php

namespace App\Http\Controllers\Admin; // PASTIKAN ADMIN

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori; // Tambahkan ini agar tidak error
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with('kategori')->latest()->get();
        return view('admin.bukus.index', compact('bukus'));
    }

    // --- SOLUSI ERROR image_c03181.png ($kategoris) ---
    public function create()
    {
        // Kamu HARUS mengambil data kategori agar looping @foreach di view tidak error
        $kategoris = \App\Models\Kategori::all(); 
        return view('admin.bukus.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'stok' => 'required|integer',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Ambil data kecuali gambar dulu
        $data = $request->only(['judul', 'kategori_id', 'stok', 'deskripsi']);

        // 3. Logika Upload Gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_gambar = time() . '.' . $file->getClientOriginalExtension();
            
            // Simpan ke folder public/storage/bukus
            $file->move(public_path('storage/bukus'), $nama_gambar);
            
            // Masukkan nama file ke array data
            $data['gambar'] = $nama_gambar;
        }

        // 4. Simpan ke Database
        Buku::create($data);

        return redirect()->route('admin.bukus.index')->with('success', 'Data buku berhasil ditambahkan!');
    }

    // --- SOLUSI ERROR image_c0a21f.png (edit) ---
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.bukus.edit', compact('buku', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);
        $buku->update($request->all());
        return redirect()->route('admin.bukus.index')->with('success', 'Buku diupdate!');
    }

    public function destroy($id)
    {
        Buku::findOrFail($id)->delete();
        return back()->with('success', 'Buku dihapus!');
    }
}