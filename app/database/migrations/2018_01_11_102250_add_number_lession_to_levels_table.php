<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNumberLessionToLevelsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('levels', function(Blueprint $table) {
            $table->integer('number_lession')->after('subject_id')->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('levels', function(Blueprint $table) {
            $table->dropColumn('number_lession');
        });
	}

}
