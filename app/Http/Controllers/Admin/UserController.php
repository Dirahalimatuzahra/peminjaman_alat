<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Tampilkan Daftar Anggota (Tugas: CRUD Kelola Anggota)
    public function index(Request $request)
    {
        $query = $request->input('search');
        
        // Mencari pengguna berdasarkan nama atau email
        $users = \App\Models\User::when($query, function ($q) use ($query) {
            return $q->where('name', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%");
        })
        ->where('role', '!=', 'admin') // Opsional: Hanya mencari user non-admin
        ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    // Form Tambah Anggota/Petugas
    public function create()
    {
        return view('admin.users.create');
    }

    // Simpan Anggota Baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:peminjam,petugas',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Anggota berhasil ditambahkan!');
    }

    // Hapus Anggota
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Anggota berhasil dihapus!');
    }
}