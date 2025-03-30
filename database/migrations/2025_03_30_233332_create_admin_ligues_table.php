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
        Schema::create('admins_ligues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ligue_id');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();

            $table->foreign('ligue_id')->references('id')->on('ligues')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_ligues');
    }
};
