<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index()
    {
        $alats = Alat::with('kategori')->latest()->get();
        return view('petugas.alats.index', compact('alats'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('petugas.alats.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required',
            'stok' => 'required|integer',
            'kategori_id' => 'required'
        ]);

        Alat::create($request->all());
        return redirect()->route('petugas.alats.index')->with('success', 'Alat berhasil ditambahkan');
    }

    // Tambahkan method edit, update, dan destroy sesuai kebutuhan...
}