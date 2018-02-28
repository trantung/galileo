<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHoursSpDetail extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sp_detail', function(Blueprint $table) {
            $table->string('lesson_hour')->after('id')->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sp_detail', function(Blueprint $table) {
            $table->dropColumn('lesson_hour');
        });
	}

}
