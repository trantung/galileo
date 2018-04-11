<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLandingId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('landing_pages', function(Blueprint $table) {
            $table->integer('landing_id')->after('id')->default(1);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('landing_pages', function(Blueprint $table) {
            $table->dropColumn('landing_id');
        });
	}

}
