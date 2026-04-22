<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// --- IMPORT CONTROLLER ADMIN ---
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BukuController as AdminBukuController;
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
 * REDIRECT DASHBOARD UTAMA
 * Menangani pengalihan otomatis berdasarkan role setelah login.
 */
Route::get('/dashboard', function () {
    $role = auth()->user()->role;
    
    if ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    
    // Perbaikan: Harus diarahkan ke 'peminjam.dashboard' agar sesuai dengan grup di bawah
    return redirect()->route('peminjam.dashboard');
})->middleware(['auth'])->name('dashboard');

/**
 * ROUTE GROUP ADMIN
 */
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('bukus', AdminBukuController::class);
    Route::resource('peminjaman', AdminPeminjaman::class); 
    Route::resource('pengembalians', PengembalianController::class);
});

/**
 * ROUTE GROUP USER (PEMINJAM)
 */
// Nama grup diatur menjadi 'peminjam.' agar sesuai dengan struktur view dan controller Anda
Route::middleware(['auth', 'role:peminjam'])->prefix('user')->name('peminjam.')->group(function () {
    Route::get('/dashboard', [UserDashboard::class, 'index'])->name('dashboard');
    Route::get('/bukus', [UserBukuController::class, 'index'])->name('bukus.index');
    Route::resource('peminjaman', UserPeminjamanController::class);
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