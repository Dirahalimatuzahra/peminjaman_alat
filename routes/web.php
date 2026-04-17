<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Import Controller Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AlatController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\Admin\PengembalianController;

// Import Controller Role Lain
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboard;
use App\Http\Controllers\Peminjam\DashboardController as PeminjamDashboard;

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
    // Dashboard Admin
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    // CRUD Routes
    Route::resource('users', UserController::class);
    Route::resource('alats', AlatController::class);
    Route::resource('kategoris', KategoriController::class);

    // Khusus Peminjaman: Saya tambahkan route untuk update status secara cepat
    Route::resource('peminjamans', PeminjamanController::class);
    Route::patch('peminjamans/{peminjaman}/kembalikan', [PeminjamanController::class, 'kembalikan'])->name('peminjamans.kembalikan');

    Route::resource('pengembalians', PengembalianController::class);
});

/**
 * ROUTE GROUP PETUGAS
 */
Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', [PetugasDashboard::class, 'index'])->name('dashboard');

    // Petugas biasanya juga butuh akses CRUD Alat & Peminjaman
    Route::resource('alats', AlatController::class);
    Route::resource('peminjamans', PeminjamanController::class);
});

/**
 * ROUTE GROUP PEMINJAM
 */
Route::middleware(['auth', 'role:peminjam'])->prefix('peminjam')->name('peminjam.')->group(function () {
    Route::get('/dashboard', [PeminjamDashboard::class, 'index'])->name('dashboard');
    // Peminjam hanya bisa melihat daftar alat dan riwayat pinjamannya sendiri
    Route::get('/alats', [AlatController::class, 'index'])->name('alats.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
