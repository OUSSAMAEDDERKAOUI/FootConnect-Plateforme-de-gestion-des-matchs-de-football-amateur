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
        Schema::create('medecins', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->string('licence');
        $table->enum('specialite', ['Traumatologie', 'Physiothérapie', 'Médecine générale']);
        $table->enum('statut', ['actif', 'suspendu']);          
        $table->timestamps();
        $table->foreignId('equipe_id')->constrained('equipes')->onDelete('cascade');

    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medecins');
    }
};
