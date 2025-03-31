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
        Schema::create('AdminEquipes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('equipe_id');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
            $table->foreign('equipe_id')->references('id')->on('equipes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_equipes');
    }
};
