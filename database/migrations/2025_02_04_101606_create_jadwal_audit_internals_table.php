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
        Schema::create('jadwal_audit_internals', function (Blueprint $table) {
            $table->id();
            $table->date('tgl')->nullable();
            $table->string('waktu')->nullable();
            $table->string('bagian')->nullable();
            $table->string('proses')->nullable();
            $table->string('auditor')->nullable();
            $table->string('audite')->nullable();
            $table->string('admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_audit_internals');
    }
};
