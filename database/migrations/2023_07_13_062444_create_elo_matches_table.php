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
        Schema::create('elo_matches', function (Blueprint $table) {
            $table->id();
            $table->json('hero_info');
            $table->json('turns');
            $table->dateTime('start_time');
            $table->unsignedTinyInteger('turn_number');
            $table->unsignedTinyInteger('status');
            $table->unsignedBigInteger('winner')->index();
            $table->unsignedBigInteger('loser')->index();
            $table->unsignedTinyInteger('type')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elo_matches');
    }
};
