<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Import Controller Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AlatController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PeminjamanController as AdminPeminjaman;
use App\Http\Controllers\Admin\PengembalianController;

// Import Controller Petugas
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboard;

// Import Controller Peminjam (DISESUAIKAN DENGAN FOLDER KHUSUS PEMINJAM)
use App\Http\Controllers\Peminjam\DashboardController as PeminjamDashboard;
use App\Http\Controllers\Peminjam\PeminjamanController as PeminjamPinjamController; // Controller baru Anda

Route::get('/', function () {
    return view('welcome');
});

/**
 * REDIRECT DASHBOARD UTAMA
 */
Route::get('/dashboard', function () {
    /** @var \App\Models\User $user */
    $user = auth()->user();

    if (!$user) {
        return redirect()->route('login');
    }

    $role = $user->role;

    if ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($role === 'petugas') {
        return redirect()->route('petugas.dashboard');
    } else {
        return redirect()->route('peminjam.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

/**
 * ROUTE GROUP ADMIN
 */
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('alats', AlatController::class);
    Route::resource('kategoris', KategoriController::class);
    Route::resource('peminjamans', AdminPeminjaman::class);
    Route::resource('pengembalians', PengembalianController::class);
    Route::post('/pengembalians/konfirmasi', [PengembalianController::class, 'konfirmasi'])->name('pengembalians.konfirmasi');
});

/**
 * ROUTE GROUP PETUGAS
 */
Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', [PetugasDashboard::class, 'index'])->name('dashboard');
    Route::resource('alats', AlatController::class);
    Route::resource('peminjamans', AdminPeminjaman::class);
});

/**
 * ROUTE GROUP PEMINJAM (SUDAH DISINKRONKAN DENGAN CONTROLLER PEMINJAM)
 */
Route::middleware(['auth', 'role:peminjam'])->prefix('peminjam')->name('peminjam.')->group(function () {
    // Dashboard Utama Peminjam
    Route::get('/dashboard', [PeminjamDashboard::class, 'index'])->name('dashboard');
    
    // Daftar Alat untuk Peminjam (Menggunakan Controller Admin untuk Data Alat)
    Route::get('/alats', [AlatController::class, 'index'])->name('alats.index');
    
    // Peminjaman Khusus Peminjam (MENGGUNAKAN CONTROLLER DI FOLDER PEMINJAM)
    // 1. Riwayat Pinjam (Jika belum ada view index, arahkan ke dashboard/create sesuai logika Controller)
    Route::get('/peminjamans', [PeminjamPinjamController::class, 'index'])->name('peminjamans.index');
    
    // 2. Form Input Pinjam (Peminjam akan melihat file di resources/views/peminjam/create.blade.php)
    Route::get('/peminjamans/create', [PeminjamPinjamController::class, 'create'])->name('peminjamans.create');
    
    // 3. Proses Simpan
    Route::post('/peminjamans', [PeminjamPinjamController::class, 'store'])->name('peminjamans.store');
});

/**
 * PROFILE ROUTES
 */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';