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
		    $table->integer('user_id')->nullable();
		    $table->integer('time_id')->nullable();
		    $table->string('start_time', 225)->nullable();
		    $table->string('end_time', 225)->nullable();
		    $table->tinyInteger('status')->default(1)->nullable();
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
		Schema::drop('free_time_user');
	}

}
