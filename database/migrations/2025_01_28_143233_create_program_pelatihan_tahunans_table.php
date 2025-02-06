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
        Schema::create('program_pelatihan_tahunans', function (Blueprint $table) {
            $table->id();
            $table->string('materi_pelatihan');
            $table->enum('sumber', ['internal', 'eksternal']);
            $table->string('narasumber');
            $table->string('sasaran_peserta');
            $table->date('tgl_rencana');
            $table->date('tgl_realisasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_pelatihan_tahunans');
    }
};
