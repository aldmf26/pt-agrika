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
        Schema::create('berita_acara_pemusnahans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->string('jumlah');
            $table->string('cakupan');
            $table->string('alasan');
            $table->date('tgl');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita_acara_pemusnahans');
    }
};
