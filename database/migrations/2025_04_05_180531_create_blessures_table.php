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
        Schema::create('blessures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('joueur_id');
            $table->unsignedBigInteger('game_id')->nullable();

            $table->date('date_blessure');
            $table->string('type'); 
            $table->text('description')->nullable();
            $table->date('retour_estime')->nullable(); 
            $table->timestamps();
        
            $table->foreign('joueur_id')->references('id')->on('joueurs')->onDelete('cascade');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');

        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blessures');
    }
};
