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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->integer('nombre_journée');
            $table->unsignedBigInteger('equipe_domicile_id');
            $table->unsignedBigInteger('equipe_exterieur_id');
            $table->unsignedBigInteger('ligue_id');

            $table->dateTime('date_heure')->nullable();
            $table->string('lieu')->nullable();
            $table->integer('score_domicile')->nullable();
            $table->integer('score_exterieur')->nullable();
            $table->unsignedBigInteger('arbitre_central_id')->nullable();
            $table->unsignedBigInteger('assistant_1_id')->nullable();
            $table->unsignedBigInteger('assistant_2_id')->nullable();
            $table->unsignedBigInteger('delegue_id')->nullable();
            $table->enum('statut', ['à venir','programmé', 'en cours', 'terminé', 'annulé'])->default('à venir');
            $table->timestamps();
        
            $table->foreign('equipe_domicile_id')->references('id')->on('equipes')->onDelete('cascade');
            $table->foreign('equipe_exterieur_id')->references('id')->on('equipes')->onDelete('cascade');
            $table->foreign('ligue_id')->references('id')->on('ligues')->onDelete('cascade');
            $table->foreign('arbitre_central_id')->references('id')->on('arbitres')->onDelete('cascade');
            $table->foreign('assistant_1_id')->references('id')->on('arbitres')->onDelete('cascade');
            $table->foreign('assistant_2_id')->references('id')->on('arbitres')->onDelete('cascade');
            $table->foreign('delegue_id')->references('id')->on('delegues')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
