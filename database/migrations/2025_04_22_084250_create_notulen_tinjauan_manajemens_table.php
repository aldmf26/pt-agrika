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
        Schema::create('notulen_tinjauan_manajemens', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->text('agenda');
            $table->text('hasil_pembahasan');
            $table->text('action_plan');
            $table->string('pic');
            $table->string('duedate');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notulen_tinjauan_manajemens');
    }
};
