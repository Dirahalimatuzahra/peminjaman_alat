<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk menambah kolom deskripsi.
     */
    public function up(): void
    {
        Schema::table('bukus', function (Blueprint $table) {
            // nullable() digunakan agar data lama tidak error saat kolom ini ditambah
            // after('stok') meletakkan kolom ini tepat setelah kolom stok di database
            $table->text('deskripsi')->nullable()->after('stok');
        });
    }

    /**
     * Membatalkan migrasi (hapus kolom deskripsi).
     */
    public function down(): void
    {
        Schema::table('bukus', function (Blueprint $table) {
            // Tambahkan ini agar kolom dihapus saat rollback
            $table->dropColumn('deskripsi');
        });
    }
};