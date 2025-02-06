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
        Schema::create('laporan_audit_internals', function (Blueprint $table) {
            $table->id();
            $table->string('departemen')->nullable();
            $table->date('tgl_audit')->nullable();
            $table->text('laporan_audit')->nullable();
            $table->string('no_ftp')->nullable();
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
        Schema::dropIfExists('laporan_audit_internals');
    }
};
