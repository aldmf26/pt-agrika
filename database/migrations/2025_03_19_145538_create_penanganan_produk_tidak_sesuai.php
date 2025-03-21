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
        Schema::create('penanganan_produk_tidak_sesuai', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_kejadian');
            $table->string('sumber_penyebab');
            $table->string('nama_produk');
            $table->string('kode_produksi');
            $table->double('jumlah_produk');
            $table->string('status');
            $table->text('penanganan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penanganan_produk_tidak_sesuai');
    }
};
