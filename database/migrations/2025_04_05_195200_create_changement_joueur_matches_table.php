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
        Schema::create('changement_joueur_matchs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id'); 
            $table->unsignedBigInteger('joueur_entreée_id'); 
            $table->unsignedBigInteger('joueur_sortie_id'); 
            $table->unsignedBigInteger('equipe_id'); 
            $table->time('minute'); 
            $table->timestamps();
            
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade'); 
            $table->foreign('joueur_entreée_id')->references('id')->on('joueurs')->onDelete('cascade');
            $table->foreign('joueur_sortie_id')->references('id')->on('joueurs')->onDelete('cascade');  
            $table->foreign('equipe_id')->references('id')->on('equipes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('changement_joueur_matches');
    }
};
