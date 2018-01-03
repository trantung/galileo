<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldCentersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('centers', function(Blueprint $table)
     	{
			$table->integer('partner_id')->after('id');
	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('centers', function(Blueprint $table)
     	{
			$table->dropColumn('partner_id');
	    });
	}
}
