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
        // Tabel Header Penerimaan
        Schema::create('penerimaan_kemasan_header', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_penerimaan');
            $table->foreignId('id_barang')->constrained('barang');
            $table->foreignId('id_supplier')->constrained('supplier');
            $table->string('no_kendaraan', 20);
            $table->string('pengemudi', 100);
            $table->integer('jumlah_barang');
            $table->integer('jumlah_sampel');
            $table->string('kode_lot', 50)->nullable();
            $table->string('keputusan');
            $table->timestamps();
        });

        // Tabel Detail Kriteria Penerimaan  
        Schema::create('penerimaan_kemasan_kriteria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penerimaan');
            $table->string('kriteria');
            $table->boolean('check_1')->default(false);
            $table->boolean('check_2')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_penerimaan_kemasan');
    }
};
