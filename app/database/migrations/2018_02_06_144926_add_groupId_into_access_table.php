<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGroupIdIntoAccessTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('access_permission', function(Blueprint $table) {
            $table->integer('group_id')->after('id')->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('access_permission', function(Blueprint $table) {
            $table->dropColumn('group_id');
        });
	}

}
