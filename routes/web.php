<?php

use Illuminate\Support\Facades\Route;

// --- IMPORT CONTROLLER BAWAAN ---
use App\Http\Controllers\ProfileController;

// --- IMPORT CONTROLLER ADMIN ---
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BukuController as AdminBukuController;
use App\Http\Controllers\Admin\KategoriController as AdminKategoriController;
use App\Http\Controllers\Admin\PeminjamanController as AdminPeminjaman; 
use App\Http\Controllers\Admin\PengembalianController;

// --- IMPORT CONTROLLER USER (PEMINJAM) ---
use App\Http\Controllers\Peminjam\DashboardController as UserDashboard;
use App\Http\Controllers\Peminjam\BukuController as UserBukuController;
use App\Http\Controllers\Peminjam\PeminjamanController as UserPeminjamanController;

Route::get('/', function () {
    return view('welcome');
});

/**
 * REDIRECT DASHBOARD UTAMA (Role Based)
 */
Route::get('/dashboard', function () {
    $role = auth()->user()->role;
    
    if ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    
    return redirect()->route('peminjam.dashboard');
})->middleware(['auth'])->name('dashboard');

/**
 * ROUTE GROUP ADMIN
 */
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    
    // Kelola Pengguna
    // PENTING: Route search harus di atas resource agar tidak dianggap sebagai ID
    Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
    Route::resource('users', UserController::class); 
    
    // Kelola Buku & Kategori
    Route::resource('bukus', AdminBukuController::class);
    Route::resource('kategori', AdminKategoriController::class);
    
    // Kelola Peminjaman & Pengembalian
    Route::patch('/pengembalian/{id}', [AdminPeminjaman::class, 'kembalikan'])->name('pengembalian.store');
    Route::resource('peminjaman', AdminPeminjaman::class); 
});

/**
 * ROUTE GROUP USER (PEMINJAM)
 */
Route::middleware(['auth', 'role:peminjam'])->prefix('user')->name('peminjam.')->group(function () {
    Route::get('/dashboard', [UserDashboard::class, 'index'])->name('dashboard');
    
    // Daftar Buku & Transaksi Peminjaman
    Route::resource('bukus', UserBukuController::class);
    Route::resource('peminjaman', UserPeminjamanController::class);
});

/**
 * DEFAULT PROFILE ROUTES
 */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';