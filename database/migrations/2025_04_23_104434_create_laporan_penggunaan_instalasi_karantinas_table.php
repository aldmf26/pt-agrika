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
        Schema::create('laporan_penggunaan_instalasi_karantinas', function (Blueprint $table) {
            $table->id();
            $table->date('nota');
            $table->date('tgl');
            $table->string('jenis_media_pembawa');
            $table->string('jumlah');
            $table->string('negara_asal');
            $table->string('negara_tujuan');
            $table->string('tgl_pengeluaran');
            $table->string('petugas_karantina_hewan');
            $table->string('kejadian');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_penggunaan_instalasi_karantinas');
    }
};
