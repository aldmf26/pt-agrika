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
        Schema::create('penimbangan_hasil_produksis', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('jenis_produk');
            $table->string('kode_batch');
            $table->double('pcs');
            $table->double('gr');
            $table->double('box');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penimbangan_hasil_produksis');
    }
};
