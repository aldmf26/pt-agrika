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
        Schema::create('checklist_perawatan_mesins', function (Blueprint $table) {
            $table->id();
            $table->integer('mesin_id');
            $table->date('tgl');
            $table->string('kriteria_pemeriksaan');
            $table->string('mode');
            $table->string('hasil_pemeriksaan');
            $table->string('status');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checklist_perawatan_mesins');
    }
};
