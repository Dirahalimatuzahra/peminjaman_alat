<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Alat;
use App\Models\User;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        // Admin melihat semua data peminjaman
        $peminjamans = Peminjaman::with(['user', 'alat'])->latest()->get();
        return view('admin.peminjamans.index', compact('peminjamans'));
    }

    public function create(Request $request)
    {
        $users = User::all();
        $alats = Alat::where('stok', '>', 0)->get();
        $alat_id = $request->query('alat_id');
        $selected_alat = $alat_id ? Alat::find($alat_id) : null;

        return view('admin.peminjamans.create', compact('users', 'alats', 'selected_alat'));
    }

    // Logika store admin tetap ada jika admin ingin menginputkan pinjaman untuk siswa
}