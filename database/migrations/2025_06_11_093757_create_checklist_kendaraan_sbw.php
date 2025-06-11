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
        Schema::create('checklist_kendaraan_sbw', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('nomor_kendaraan');
            $table->string('pengemudi');
            $table->string('jenis_kendaraan');
            $table->string('ekspedisi');
            $table->time('jam_datang');
            $table->string('noreg_rumah_walet');
            $table->string('keputusan');
            $table->string('pemeriksa');
            $table->text('komentar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checklist_kendaraan_sbw');
    }
};
