<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    /**
     * Menampilkan daftar alat.
     */
    public function index()
    {
        // Mengambil data alat beserta relasi kategorinya
        $alats = Alat::with('kategori')->get();
        return view('admin.alats.index', compact('alats'));
    }

    /**
     * Menampilkan form tambah alat.
     */
    public function create()
    {
        // Mengambil semua kategori untuk pilihan di form
        $kategoris = Kategori::all();
        return view('admin.alats.create', compact('kategoris'));
    }

    /**
     * Menyimpan data alat baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_alat'   => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'stok'        => 'required|integer|min:0',
            'deskripsi'   => 'nullable|string',
        ]);

        Alat::create($request->all());

        return redirect()->route('admin.alats.index')
            ->with('success', 'Alat berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail alat (opsional).
     */
    public function show(string $id)
    {
        $alat = Alat::with('kategori')->findOrFail($id);
        return view('admin.alats.show', compact('alat'));
    }

    /**
     * Menampilkan form edit alat.
     */
    public function edit(string $id)
    {
        $alat = Alat::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.alats.edit', compact('alat', 'kategoris'));
    }

    /**
     * Memperbarui data alat.
     */
    public function update(Request $request, string $id)
    {
        $alat = Alat::findOrFail($id);

        $request->validate([
            'nama_alat'   => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'stok'        => 'required|integer|min:0',
            'deskripsi'   => 'nullable|string',
        ]);

        $alat->update($request->all());

        return redirect()->route('admin.alats.index')
            ->with('success', 'Data alat berhasil diperbarui.');
    }

    /**
     * Menghapus data alat.
     */
    public function destroy(string $id)
    {
        $alat = Alat::findOrFail($id);
        $alat->delete();

        return redirect()->route('admin.alats.index')
            ->with('success', 'Alat berhasil dihapus.');
    }
}
