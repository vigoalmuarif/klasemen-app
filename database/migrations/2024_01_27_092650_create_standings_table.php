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
        Schema::create('standings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('club_id')->constrained('clubs');
            $table->integer('playing_games');
            $table->integer('points');
            $table->integer('wins');
            $table->integer('draws');
            $table->integer('losses');
            $table->integer('goals_wins');
            $table->integer('goals_losses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('standings');
    }
};
