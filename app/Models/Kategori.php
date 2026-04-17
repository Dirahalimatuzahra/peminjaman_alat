<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Tambahkan ini agar data bisa disimpan ke database
    protected $fillable = ['nama_kategori'];

    // Relasi ke Alat (Satu kategori punya banyak alat)
    public function alats()
    {
        return $this->hasMany(Alat::class);
    }
}
