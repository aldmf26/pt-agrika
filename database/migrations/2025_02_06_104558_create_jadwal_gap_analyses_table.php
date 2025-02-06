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
        Schema::create('jadwal_gap_analyses', function (Blueprint $table) {
            $table->id();
            $table->integer('divisi_id')->index();
            $table->integer('bulan_rencana');
            $table->integer('tahun_rencana');
            $table->integer('tgl_dari');
            $table->integer('tgl_sampai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_gap_analyses');
    }
};
