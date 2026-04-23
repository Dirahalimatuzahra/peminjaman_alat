<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            ['nama_kategori' => 'Pelajaran'],
            ['nama_kategori' => 'Cerita'],
            ['nama_kategori' => 'Dongeng'],
            ['nama_kategori' => 'Komik'],
        ];

        foreach ($kategoris as $k) {
            Kategori::create($k);
        }
    }
}