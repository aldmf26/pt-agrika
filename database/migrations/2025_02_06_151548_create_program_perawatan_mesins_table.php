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
        Schema::create('program_perawatan_mesins', function (Blueprint $table) {
            $table->id();
            $table->integer('item_mesin_id')->index();
            $table->string('frekuensi_perawatan');
            $table->string('penanggung_jawab');
            $table->date('tanggal_mulai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_perawatan_mesins');
    }
};
