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
        Schema::create('equipes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('telephone');
            $table->string('logo');
            $table->enum('categorie', [ 'U13', 'U15', 'U17', 'U19','U23','Senior'])->default('Senior');
            $table->enum('statut',['Traité',"En attente"])->default('En attente');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipes');
    }
};
