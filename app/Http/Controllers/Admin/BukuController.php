<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::all();
        return view('admin.bukus.index', compact('bukus'));
    }

    public function create()
    {
        return view('admin.bukus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_buku' => 'required|string|max:255',
            'stok'      => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            $data = $request->only(['nama_buku', 'stok', 'deskripsi']);

            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $nama_file = time() . "_" . $file->getClientOriginalName();
                $file->move(public_path('storage/bukus'), $nama_file);
                $data['gambar'] = $nama_file;
            }

            Buku::create($data);
            return redirect()->route('admin.bukus.index')->with('success', 'Buku Berhasil Disimpan!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Gagal menyimpan: ' . $e->getMessage()]);
        }
    }

    public function show(string $id)
    {
        $buku = Buku::findOrFail($id);
        return view('admin.bukus.show', compact('buku'));
    }

    public function edit(string $id)
    {
        $buku = Buku::findOrFail($id);
        return view('admin.bukus.edit', compact('buku'));
    }

    public function update(Request $request, string $id)
    {
        $buku = Buku::findOrFail($id);

        $request->validate([
            'nama_buku' => 'required|string|max:255',
            'stok'      => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            $data = $request->only(['nama_buku', 'stok', 'deskripsi']);

            if ($request->hasFile('gambar')) {
                if ($buku->gambar && file_exists(public_path('storage/bukus/' . $buku->gambar))) {
                    unlink(public_path('storage/bukus/' . $buku->gambar));
                }

                $file = $request->file('gambar');
                $nama_file = time() . "_" . $file->getClientOriginalName();
                $file->move(public_path('storage/bukus'), $nama_file);
                $data['gambar'] = $nama_file;
            }

            $buku->update($data);
            return redirect()->route('admin.bukus.index')->with('success', 'Data buku berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Gagal memperbarui: ' . $e->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        $buku = Buku::findOrFail($id);
        if ($buku->gambar && file_exists(public_path('storage/bukus/' . $buku->gambar))) {
            unlink(public_path('storage/bukus/' . $buku->gambar));
        }
        $buku->delete();
        return redirect()->route('admin.bukus.index')->with('success', 'Buku berhasil dihapus.');
    }
}