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
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->string('licence');
        $table->enum('specialite', ['Traumatologie', 'Physiothérapie', 'Médecine générale']);
        $table->enum('statut', ['actif', 'suspendu']);          
        $table->timestamps();
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
