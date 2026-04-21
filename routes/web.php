<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// --- IMPORT CONTROLLER ADMIN ---
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AlatController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PeminjamanController as AdminPeminjaman; 
use App\Http\Controllers\Admin\PengembalianController;

// --- IMPORT CONTROLLER PETUGAS ---
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboard;
use App\Http\Controllers\Petugas\AlatController as PetugasAlat;

// --- IMPORT CONTROLLER PEMINJAM ---
use App\Http\Controllers\Peminjam\AlatController as PeminjamAlatController;
use App\Http\Controllers\Peminjam\PeminjamanController as UserPeminjamanController;
use App\Http\Controllers\Peminjam\DashboardController as PeminjamDashboard; // Alias yang benar

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
    // Dashboard
    Route::get('/dashboard', [PetugasDashboard::class, 'index'])->name('dashboard');
    
    // Resource untuk Data Alat
    Route::resource('alats', PetugasAlat::class);
    
    // Halaman daftar konfirmasi
    Route::get('/peminjaman', [AdminPeminjaman::class, 'index'])->name('peminjamans.index');
    
    // Aksi Konfirmasi & Tolak
    Route::post('/peminjaman/{id}/konfirmasi', [AdminPeminjaman::class, 'konfirmasi'])->name('peminjamans.konfirmasi');
    Route::post('/peminjaman/{id}/tolak', [AdminPeminjaman::class, 'tolak'])->name('peminjamans.tolak');
});

/**
 * ROUTE GROUP PEMINJAM
 */
/**
 * ROUTE GROUP PEMINJAM
 */
Route::middleware(['auth', 'role:peminjam'])->prefix('peminjam')->name('peminjam.')->group(function () {
    Route::get('/dashboard', [PeminjamDashboard::class, 'index'])->name('dashboard');
    // Route untuk daftar alat
    Route::get('/alats', [PeminjamAlatController::class, 'index'])->name('alats.index');
    
    // --- TAMBAHKAN ROUTE INI ---
    // Route untuk form peminjaman (Ini yang dicari oleh error Anda)
    Route::get('/alats/pinjam', [UserPeminjamanController::class, 'create'])->name('alats.create');
    
    // Route untuk proses simpan pinjaman
    Route::post('/alats/store', [UserPeminjamanController::class, 'store'])->name('alats.store');

    // Riwayat peminjaman
    Route::get('/peminjaman', [UserPeminjamanController::class, 'index'])->name('peminjaman.index');
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