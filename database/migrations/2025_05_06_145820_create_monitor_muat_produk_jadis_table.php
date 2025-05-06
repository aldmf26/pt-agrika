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
        Schema::create('monitor_muat_produk_jadis', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_masuk')->nullable();
            $table->date('tgl_keluar')->nullable();
            $table->time('mulai')->nullable();
            $table->time('selesai')->nullable();
            $table->string('no_mobil')->nullable();
            $table->string('no_do')->nullable();
            $table->string('nm_produk');
            $table->string('kode_produk');
            $table->double('kg');
            $table->string('nm_ekspedisi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitor_muat_produk_jadis');
    }
};
