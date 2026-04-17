<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Alat;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data ringkasan untuk dashboard
        $data = [
            'total_user' => User::count(),
            'total_alat' => Alat::count(),
            'total_peminjaman' => Peminjaman::count(),
            'peminjaman_terbaru' => Peminjaman::with(['user', 'alat'])->latest()->take(5)->get()
        ];

        // Mengirim data ke file view di resources/views/admin/dashboard.blade.php
        return view('admin.dashboard', $data);
    }
}
