<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lessons', function($table)
		{
			$table->increments('id');
		    $table->string('name', 225);
		    $table->string('code', 125);
		    $table->integer('class_id');
		    $table->integer('subject_id');
		    $table->integer('level_id');
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
		Schema::dropIfExists('lessons');
	}

}
