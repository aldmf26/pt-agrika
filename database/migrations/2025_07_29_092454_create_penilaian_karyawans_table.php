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
        Schema::create('penilaian_karyawans', function (Blueprint $table) {
            $table->id();
            $table->integer('id_anak');
            $table->string('periode');
            $table->string('pendidikan_standar');
            $table->string('pendidikan_hasil');
            $table->string('pengalaman_standar');
            $table->string('pengalaman_hasil');
            $table->string('pelatihan_standar');
            $table->string('pelatihan_hasil');
            $table->string('keterampilan_standar');
            $table->string('keterampilan_hasil');
            $table->string('kompetensi_inti_standar');
            $table->string('kompetensi_inti_hasil');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_karyawans');
    }
};
