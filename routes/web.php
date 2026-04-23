<?php

use Illuminate\Support\Facades\Route;

// --- IMPORT CONTROLLER BAWAAN ---
use App\Http\Controllers\ProfileController;

// --- IMPORT CONTROLLER ADMIN ---
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BukuController as AdminBukuController;
use App\Http\Controllers\Admin\PeminjamanController as AdminPeminjaman; 
use App\Http\Controllers\Admin\PengembalianController;
use App\Http\Controllers\Admin\AdminProfileController as AdminProfileController;

// --- IMPORT CONTROLLER USER (PEMINJAM) ---
use App\Http\Controllers\Peminjam\DashboardController as UserDashboard;
use App\Http\Controllers\Peminjam\BukuController as UserBukuController;
use App\Http\Controllers\Peminjam\PeminjamanController as UserPeminjamanController;

Route::get('/', function () {
    return view('welcome');
});

/**
 * REDIRECT DASHBOARD UTAMA
 * Menangani pengalihan otomatis berdasarkan role setelah login.
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
 * Menangani semua tugas Admin: Kelola Anggota, CRUD Buku, Transaksi, dan Profil.
 */
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    
    // Kelola & Cari Pengguna (Gunakan resource atau route manual untuk pencarian)
    Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
    Route::resource('users', UserController::class);
    
    // Resource lainnya tetap sama
    Route::resource('bukus', AdminBukuController::class);
    Route::resource('peminjaman', AdminPeminjaman::class); 
});

/**
 * ROUTE GROUP USER (PEMINJAM)
 * Menangani tugas User: Daftar, Login, Peminjaman, dan Pencarian Buku.
 */
Route::middleware(['auth', 'role:peminjam'])->prefix('user')->name('peminjam.')->group(function () {
    Route::get('/dashboard', [UserDashboard::class, 'index'])->name('dashboard');
    Route::get('/bukus', [UserBukuController::class, 'index'])->name('bukus.index');
    Route::resource('peminjaman', UserPeminjamanController::class);
});

/**
 * DEFAULT PROFILE ROUTES (Laravel Breeze)
 * Tetap dipertahankan untuk kebutuhan profil dasar atau jika role lain membutuhkannya.
 */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';