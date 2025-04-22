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
        Schema::create('agendadan_jadwal_tinjauan_manajemens', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->time('dari_jam');
            $table->time('sampai_jam');
            $table->string('agenda');
            $table->string('pic');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendadan_jadwal_tinjauan_manajemens');
    }
};
