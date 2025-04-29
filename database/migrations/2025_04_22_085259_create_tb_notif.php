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
        Schema::create('tb_notif', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('departemen');
            $table->string('nama');
            $table->integer('month');
            $table->integer('year');
            $table->string('pesan')->nullable();
            $table->boolean('is_read')->default(FALSE);
            $table->string('route_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_notif');
    }
};
