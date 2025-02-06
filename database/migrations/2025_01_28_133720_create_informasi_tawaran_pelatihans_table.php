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
        Schema::create('informasi_tawaran_pelatihan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('jenis');
            $table->string('sasaran');
            $table->string('tema');
            $table->string('sumber_informasi');
            $table->string('personil_penghubung');
            $table->string('no_telp');
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi_tawaran_pelatihan');
    }
};
