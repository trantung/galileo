<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeVarcharToTIMEField extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('ALTER TABLE sp_detail CHANGE lesson_hour lesson_hour TIME;');
		DB::statement('ALTER TABLE sp_detail CHANGE lesson_date lesson_date DATE;');

		DB::statement('ALTER TABLE free_time_user CHANGE start_time start_time TIME;');
		DB::statement('ALTER TABLE free_time_user CHANGE end_time end_time TIME;');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('ALTER TABLE sp_detail CHANGE lesson_hour lesson_hour VARCHAR(255);');
		DB::statement('ALTER TABLE sp_detail CHANGE lesson_date lesson_date VARCHAR(255);');
		
		DB::statement('ALTER TABLE free_time_user CHANGE start_time start_time VARCHAR(255);');
		DB::statement('ALTER TABLE free_time_user CHANGE end_time end_time VARCHAR(255);');
	}

}
