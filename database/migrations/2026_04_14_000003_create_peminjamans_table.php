<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('buku_id')->constrained('bukus');
            $table->foreignId('admin_id')->nullable()->constrained('users');
            $table->integer('jumlah'); 
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali')->nullable();
            // Pastikan 'disetujui' dan 'ditolak' sudah ada di sini
            $table->enum('status', ['pending', 'disetujui', 'dipinjam', 'kembali', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjamans'); // Pastikan 'peminjamans', bukan 'peminjamen'
    }
};