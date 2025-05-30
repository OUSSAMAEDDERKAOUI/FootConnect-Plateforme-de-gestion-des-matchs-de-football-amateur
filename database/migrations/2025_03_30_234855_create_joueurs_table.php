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
        Schema::create('joueurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('equipe_id');
            $table->integer('numeroMaillot');
            $table->enum('position', ['gardien', 'defenseur', 'milieu', 'attaquant']);
            $table->enum('statut', ['actif', 'suspendu', 'blesse']);         
            $table->enum('validation_status', ['en attente', 'validé', 'rejeté'])->default("en attente"); 
            $table->timestamps();
            $table->foreign('equipe_id')->references('id')->on('equipes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('joueurs');
    }
};
