<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin_sanitasi', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('posisi');
        });

        DB::table('admin_sanitasi')->insert([
            ['id_user' => 1, 'posisi' => 'petugas'],
            ['id_user' => 2, 'posisi' => 'verifikator'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_sanitasi');
    }
};
