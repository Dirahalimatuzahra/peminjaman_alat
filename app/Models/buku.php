<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    // Tambahkan baris ini untuk mengizinkan input data
    protected $fillable = [
        'nama_buku', // WAJIB ADA
        'judul', 
        'kategori_id', 
        'stok', 
        'deskripsi', 
        'gambar'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}