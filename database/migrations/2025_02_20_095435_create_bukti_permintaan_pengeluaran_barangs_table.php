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
        Schema::create('bukti_permintaan_pengeluaran_barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('departemen');
            $table->date('tgl');
            $table->string('identitas');
            $table->integer('id_barang');
            $table->double('pcs');
            $table->double('gr');
            $table->string('no_lot');
            $table->string('status');
            $table->string('penerima_wr');
            $table->string('penerima_pr');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukti_permintaan_pengeluaran_barangs');
    }
};
