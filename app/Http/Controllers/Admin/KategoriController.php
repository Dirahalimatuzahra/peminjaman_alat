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
        $kategoris = \App\Models\Kategori::all();
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
        $request->validate(['nama_kategori' => 'required|unique:kategoris']);
        \App\Models\Kategori::create($request->all());
        return back()->with('success', 'Kategori berhasil ditambahkan.');
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
        \App\Models\Kategori::findOrFail($id)->delete();
        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}