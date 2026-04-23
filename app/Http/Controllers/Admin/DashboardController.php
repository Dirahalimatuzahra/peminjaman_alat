<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Peminjaman; // Pastikan model ini sudah ada

class DashboardController extends Controller
{
    public function index()
{
    return view('admin.dashboard', [
        'total_user' => \App\Models\User::count(),
        'total_buku' => \App\Models\Buku::count(),
        'total_peminjaman' => \App\Models\Peminjaman::count(), // Tambahkan baris ini
    ]);
}
}