<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCenterIdToUserCenterLevelTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_center_level', function(Blueprint $table) {
            $table->integer('center_id')->after('user_id')->nullable();
            $table->integer('subject_id')->after('user_id')->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_center_level', function(Blueprint $table) {
            $table->dropColumn(['center_id', 'subject_id']);
        });
	}

}
