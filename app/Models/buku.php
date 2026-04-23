<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id', // Tambahkan ini agar bisa menyimpan relasi kategori
        'nama_buku', 
        'stok', 
        'deskripsi', 
        'gambar', 
    ];

    /**
     * Relasi ke model Kategori.
     * Satu buku termasuk dalam satu kategori (Many to One).
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    /**
     * Relasi ke model Peminjaman.
     * Satu buku bisa dipinjam berkali-kali.
     */
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}