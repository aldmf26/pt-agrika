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
        Schema::create('program_audit_internals', function (Blueprint $table) {
            $table->id();
            $table->string('departemen')->nullable();
            $table->string('audite')->nullable();
            $table->string('auditor')->nullable();

            // Kolom bulan (1-12) dengan default 0
            for ($i = 1; $i <= 12; $i++) {
                $table->boolean("bulan_$i")->default(0);
            }
            $table->integer('tahun')->default(0);
            $table->string('admin');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_audit_internals');
    }
};
