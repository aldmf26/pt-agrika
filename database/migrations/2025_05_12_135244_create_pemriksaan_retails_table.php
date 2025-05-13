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
        Schema::create('pemriksaan_retails', function (Blueprint $table) {
            $table->id();
            $table->string('retain_sampel');
            $table->date('tgl');
            $table->double('standar_kebutuhan');
            $table->date('production_date');
            $table->date('expired_date');
            $table->double('warna');
            $table->double('bau');
            $table->double('tekstur');
            $table->double('kandungan_nitrit');
            $table->string('dicek_oleh');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemriksaan_retails');
    }
};
