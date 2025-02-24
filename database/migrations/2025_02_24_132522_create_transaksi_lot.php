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
        Schema::create('lot', function (Blueprint $table) {
            $table->id();
            $table->integer('barang_id');
            $table->string('kode_lot');
            $table->date('tgl_kedatangan');
            $table->date('tgl_expired');
            $table->double('qty');
            $table->date('tgl');
            $table->string('admin');
            $table->timestamps();
        });

        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->integer('barang_id');
            $table->integer('lot_id');
            $table->integer('jenis');
            $table->double('qty');
            $table->double('stok_sebelum');
            $table->double('stok_sesudah');
            $table->date('tgl');
            $table->string('admin');
            $table->timestamps();
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_lot');
    }
};
