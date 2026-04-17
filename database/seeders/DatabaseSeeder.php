<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Alat;
use App\Models\Kategori;
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

        // 2. Buat Data Kategori (Sesuai Use Case CRUD Kategori)
        $kategori1 = Kategori::create(['nama_kategori' => 'Elektronik']);
        $kategori2 = Kategori::create(['nama_kategori' => 'Olahraga']);

        // 3. Buat Data Alat (Sesuai Use Case CRUD Alat)
        Alat::create([
            'kategori_id' => $kategori1->id,
            'nama_alat' => 'Proyektor Epson EB-X400',
            'stok' => 5,
        ]);

        Alat::create([
            'kategori_id' => $kategori2->id,
            'nama_alat' => 'Bola Basket Spalding',
            'stok' => 10,
        ]);

        // 4. Buat Data User (Admin, Petugas, Peminjam) sesuai Flowchart
        // Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Petugas
        User::create([
            'name' => 'Petugas Sarpras',
            'email' => 'petugas@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'petugas',
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
