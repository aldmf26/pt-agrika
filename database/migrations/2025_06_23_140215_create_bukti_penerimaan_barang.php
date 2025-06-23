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
        Schema::create('bukti_penerimaan_barang', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_terima');
            $table->unsignedBigInteger('id_produk');
            $table->integer('serah');
            $table->integer('terima');
            $table->string('nomor_batch');
            $table->string('lot');
            $table->string('barcode');
            $table->date('tanggal_produksi');
            $table->string('status');
            $table->string('nama_penerima');
            $table->string('nama_penyerah');
            $table->string('nama_ttd');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukti_penerimaan_barang');
    }
};
