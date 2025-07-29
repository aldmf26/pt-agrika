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
        Schema::create('hasil_wawancaras', function (Blueprint $table) {
            $table->id();
            $table->integer('id_anak');
            $table->string('nama');
            $table->string('nik');
            $table->date('tgl_lahir');
            $table->string('jenis_kelamin');
            $table->unsignedBigInteger('id_divisi');
            $table->text('kesimpulan');
            $table->string('keputusan');
            $table->date('tgl_masuk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_wawancaras');
    }
};
