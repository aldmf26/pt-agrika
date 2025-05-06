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
        Schema::create('produk_releases', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->string('kode_produk');
            $table->date('tgl_panen');
            $table->date('tgl_bln_datang');
            $table->string('no_reg_walet');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_releases');
    }
};
