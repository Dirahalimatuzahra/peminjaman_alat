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
    Schema::rename('alats', 'bukus');
    // Jika ada kolom nama_alat, ubah menjadi judul_buku
    Schema::table('bukus', function (Blueprint $table) {
        $table->renameColumn('nama_alat', 'judul_buku');
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
