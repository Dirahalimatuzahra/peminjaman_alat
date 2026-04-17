<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Menampilkan daftar kategori
     */
    public function index()
    {
        $kategoris = Kategori::all();
        return view('admin.kategoris.index', compact('kategoris'));
    }

    /**
     * MENAMBAHKAN FUNGSI INI AGAR TIDAK ERROR LAGI
     * Menampilkan halaman form tambah kategori
     */
    public function create()
    {
        return view('admin.kategoris.create');
    }

    /**
     * Menyimpan data kategori baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        Kategori::create($request->all());

        return redirect()->route('admin.kategoris.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Menampilkan halaman edit kategori
     */
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategoris.edit', compact('kategori'));
    }

    /**
     * Memperbarui data kategori di database
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());

        return redirect()->route('admin.kategoris.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Menghapus data kategori
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return redirect()->route('admin.kategoris.index')->with('success', 'Kategori berhasil dihapus!');
    }
}