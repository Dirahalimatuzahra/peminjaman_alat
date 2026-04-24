<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $users = \App\Models\User::when($search, function($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10); // WAJIB pakai paginate(), bukan get() agar ->links() bekerja

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|min:8|confirmed',
        'role' => 'required',
    ]);

    // Pakai cara ini agar lebih terlihat jika ada yang error
    $user = new \App\Models\User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
    $user->role = $request->role;
    $user->save();

    return redirect()->route('admin.users.index')->with('success', 'User Berhasil Disimpan!');
}


public function destroy($id)
{
    // Cari user berdasarkan ID
    $user = \App\Models\User::findOrFail($id);

    // Pastikan admin tidak menghapus dirinya sendiri secara tidak sengaja
    if ($user->id === auth()->id()) {
        return redirect()->back()->with('error', 'Anda tidak bisa menghapus akun sendiri!');
    }

    // Hapus user
    $user->delete();

    // Kembalikan ke halaman index dengan pesan sukses
    return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus selamanya!');
}
}