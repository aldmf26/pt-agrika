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
        Schema::create('daftar_induk_dokumen_internal', function (Blueprint $table) {
            $table->id();
            $table->string('no_dokumen')->unique();
            $table->string('divisi');
            $table->string('pic');
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->text('tags')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_induk_dokumen_internal');
    }
};
