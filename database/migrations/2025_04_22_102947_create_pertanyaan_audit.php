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
        Schema::create('ia_headings', function (Blueprint $table) {
            $table->id();
            $table->string('departemen');
            $table->string('nama');
            $table->timestamps();
        });
        Schema::create('ia_sub_headings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('heading_id');
            $table->string('nama')->nullable();
            $table->timestamps();
        });
        Schema::create('ia_pertanyaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_heading_id');
            $table->text('teks');
            $table->integer('nomor_urutan');
            $table->timestamps();
        });
        Schema::create('ia_hasil_checklist', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pertanyaan_id');
            $table->boolean('min')->default(false);
            $table->boolean('maj')->default(false);
            $table->boolean('sr')->default(false);
            $table->boolean('kt')->default(false);
            $table->boolean('ok')->default(false);
            $table->text('keterangan')->nullable();
            $table->date('tanggal_audit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ia_headings');
        Schema::dropIfExists('ia_sub_headings');
        Schema::dropIfExists('ia_pertanyaan');
        Schema::dropIfExists('ia_hasil_checklist');
    }
};
