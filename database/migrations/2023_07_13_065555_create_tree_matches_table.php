<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tree_matches', function(Blueprint $table) {
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
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tree_matches');
	}
};
