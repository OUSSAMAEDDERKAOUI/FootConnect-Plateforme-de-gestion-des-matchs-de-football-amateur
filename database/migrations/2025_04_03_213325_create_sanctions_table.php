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
        Schema::create('sanctions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->unsignedBigInteger('joueur_id');
            
            $table->enum('type', ['Carton Jaune', 'Carton Rouge', 'Avertissement']);
            
            $table->dateTime('date_time'); 

            $table->string('duree')->nullable(); 
            $table->string('note')->nullable(); 

            $table->timestamps();
        
            
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->foreign('joueur_id')->references('id')->on('joueurs')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sanctions');
    }
};
