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
        Schema::create('tamus', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('name');
            $table->time('time_in');
            $table->time('time_out')->nullable();
            $table->text('purpose')->nullable();
            $table->enum('flu', ['ya', 'tidak']);
            $table->enum('cough', ['ya', 'tidak']);
            $table->enum('diare', ['ya', 'tidak']);
            $table->enum('fever', ['ya', 'tidak']);
            $table->enum('sore_throat', ['ya', 'tidak']);
            $table->enum('difficulty_breathing', ['ya', 'tidak']);
            $table->enum('area_covid', ['ya', 'tidak']);
            $table->enum('penderita_covid', ['ya', 'tidak']);
            $table->string('visitor_signature'); // Path file tanda tangan pengunjung
            $table->string('recipient_signature'); // Path file tanda tangan penerima
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tamus');
    }
};
