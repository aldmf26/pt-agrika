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
        Schema::create('header_laporan_penggunaan_instalasis', function (Blueprint $table) {
            $table->id();
            $table->string('nota');
            $table->string('nama_pemilik');
            $table->string('no_sk');
            $table->string('masa_berlaku');
            $table->string('jenis_media_pembawa');
            $table->string('negara_asal');
            $table->string('kapasitas');
            $table->string('perusahaan');
            $table->string('alamat');
            $table->string('no_telp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('header_laporan_penggunaan_instalasis');
    }
};
