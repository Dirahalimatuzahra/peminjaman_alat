<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('bukus', function (Blueprint $table) {
            // Tambahkan kolom yang hilang jika belum ada
            if (!Schema::hasColumn('bukus', 'judul')) $table->string('judul')->after('id');
            if (!Schema::hasColumn('bukus', 'stok')) $table->integer('stok')->default(0);
            if (!Schema::hasColumn('bukus', 'deskripsi')) $table->text('deskripsi')->nullable();
            if (!Schema::hasColumn('bukus', 'gambar')) $table->string('gambar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bukus', function (Blueprint $table) {
            //
        });
    }
};
