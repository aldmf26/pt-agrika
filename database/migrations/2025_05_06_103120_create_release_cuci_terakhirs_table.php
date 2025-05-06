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
        Schema::create('release_cuci_terakhirs', function (Blueprint $table) {
            $table->id();
            $table->time('jam');
            $table->string('nama_produk');
            $table->string('no_urut');
            $table->date('tgl');
            $table->string('hasil_pemeriksaan');
            $table->enum('status', ['Release', 'Hold', 'Reject']);
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('release_cuci_terakhirs');
    }
};
