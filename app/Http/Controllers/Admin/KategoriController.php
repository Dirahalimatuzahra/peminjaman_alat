<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view('admin.kategoris.index', compact('kategoris'));
    }

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
    public function edit(Kategori $kategori)
    {
        return view('admin.kategoris.edit', compact('kategori'));
    }

    /**
     * Memperbarui data kategori di database
     */
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategori->update($request->all());

        return redirect()->route('admin.kategoris.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('admin.kategoris.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
