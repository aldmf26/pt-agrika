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
        Schema::create('item_perawatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_item');
            $table->string('merek')->nullable();
            $table->integer('lokasi_id');
            $table->string('no_identifikasi')->nullable();
            $table->enum('jenis_item', ['gabung', 'pisah'])->default('gabung');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_perawatan');
    }
};
