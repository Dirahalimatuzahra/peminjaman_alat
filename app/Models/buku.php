<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    // Pastikan nama tabel benar
    protected $table = 'bukus';

    // Sesuaikan dengan kolom yang ada di database
    protected $fillable = [
        'nama_buku', 
        'stok', 
        'deskripsi', 
        'gambar', // Pastikan ini ada
        'kategori_id'
    ];
}