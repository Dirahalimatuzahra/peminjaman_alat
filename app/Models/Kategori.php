<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti aturan jamak Laravel (opsional)
    protected $table = 'kategoris';

    // Daftarkan kolom yang boleh diisi secara massal
    protected $fillable = [
        'nama_kategori',
    ];

    /**
     * Relasi ke model Buku.
     * Satu kategori bisa memiliki banyak buku (One to Many).
     */
    public function bukus()
    {
        return $this->hasMany(Buku::class, 'kategori_id');
    }
}