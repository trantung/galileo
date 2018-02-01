<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FreeTimeUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('free_time_user', function($table)
		{
			$table->increments('id');
		    $table->integer('user_id');
		    $table->integer('time_id');
		   	$table->string('start_time', 255);
		   	$table->string('end_time', 255);
		    $table->tinyInteger('status')->default(1);
			$table->softDeletes();
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
		Schema::dropIfExists('free_time_user');
	}

}
