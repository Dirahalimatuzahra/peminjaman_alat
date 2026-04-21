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
    'alat_id',
    'petugas_id', // Pastikan ini ada
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
     * Relasi ke Alat yang dipinjam
     */
    public function alat()
    {
        return $this->belongsTo(Alat::class);
    }

    /**
     * Relasi ke Petugas yang memverifikasi (User dengan role petugas/admin)
     */
    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}
