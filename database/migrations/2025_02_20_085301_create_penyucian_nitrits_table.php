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
        Schema::create('penyucian_nitrits', function (Blueprint $table) {
            $table->id();
            $table->integer('pegawai_id');
            $table->date('tanggal');
            $table->string('no_box');
            $table->string('nm_partai');
            $table->double('pcs');
            $table->double('gr');
            $table->time('start');
            $table->time('end');
            $table->double('waktu_penyucian');
            $table->string('nama_operator');
            $table->text('ket');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyucian_nitrits');
    }
};
