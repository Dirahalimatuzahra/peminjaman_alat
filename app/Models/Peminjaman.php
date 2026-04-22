<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans';

    protected $fillable = [
    'user_id',
    'buku_id',
    'jumlah',
    'tanggal_pinjam',
    'tanggal_kembali',
    'status',
];

    /**
     * Relasi ke Peminjam (User dengan role peminjam)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke Buku yang dipinjam
     */
    public function buku() 
    {
        return $this->belongsTo(Buku::class);
    }

    /**
     * Relasi ke Petugas yang memverifikasi (User dengan role petugas/admin)
     */
    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}
