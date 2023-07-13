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
        Schema::create('user_heroes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('hero_id')->index();
            $table->integer('acc')->default(0);
            $table->integer('atk')->default(0);
            $table->integer('atk_healing')->default(0);
            $table->integer('cc')->default(0);
            $table->integer('crit_dmg')->default(0);
            $table->integer('crit_rate')->default(0);
            $table->integer('def')->default(0);
            $table->integer('dodge')->default(0);
            $table->integer('effect_resistance')->default(0);
            $table->integer('intrinsic_status')->default(0);
            $table->integer('element')->default(0);
            $table->integer('position')->default(0);
            $table->integer('status')->default(0);
            $table->integer('take_dmg_healing')->default(0);
            $table->integer('skill')->default(0);
            $table->integer('spd')->default(0);
            $table->integer('hp')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_heroes');
    }
};
