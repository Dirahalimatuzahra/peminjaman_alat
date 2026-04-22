<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Buku;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Jalankan UserSeeder (Jika kamu ingin memisahkan data user di file lain)
        // Jika tidak ingin pakai file terpisah, data user sudah saya tulis di bawah (poin 4)
        // $this->call(UserSeeder::class);



        // 3. Buat Data Buku (Sesuai Use Case CRUD Buku)
        Buku::create([
            'nama_buku' => 'Proyektor Epson EB-X400',
            'stok' => 5,
        ]);

        Buku::create([
            'nama_buku' => 'Bola Basket Spalding',
            'stok' => 10,
        ]);

        
        // Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Peminjam (Siswa)
        User::create([
            'name' => 'Siswa Peminjam',
            'email' => 'siswa@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'peminjam',
        ]);
    }
}
