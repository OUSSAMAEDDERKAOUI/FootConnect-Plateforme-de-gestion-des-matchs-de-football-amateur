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
        Schema::create('arbitres', function (Blueprint $table) {
            $table->id();
            $table->string('numero_accreditation');
            $table->enum('niveau', [ 'régional', 'national', 'international']);
            $table->enum('poste', ['arbitre central', 'assistant', 'vidéo']);
            $table->string('experience');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arbitres');
    }
};
